<?php
session_start();
$conn = new mysqli("localhost", "root", "", "car_rental");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header("Location: index.php");
            exit();
        } else {
            $message = "Registration failed!";
        }
        $stmt->close();
    } elseif (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();

        if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header("Location: index.php");
            exit();
        } else {
            $message = "Invalid login credentials!";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="../css/style_register.css">
</head>
<body>
	<header>
        <a id="logoid" href="../php/index.php"><div class="logo">VELOCITY VAULT</div></a>
        <nav>
            <ul>
                <!---<li><a href="../html/fleet-section.html">Fleet</a></li>--->
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </nav>
    </header>
	<section class="logspace">
		<div class="form_area">
		<h1 id="form-title">Login</h1>
		<p><?php echo $message; ?></p>
		
		<form action="login.php" method="POST" id="auth-form">
			<input type="email" name="email" placeholder="Email" required><br><br>
			<input type="password" name="password" placeholder="Password" required><br><br>

			<div id="register-fields" style="display:none;">
				<input type="text" name="name" placeholder="Full Name"><br><br>
				<input type="password" name="confirm_password" placeholder="Confirm Password"><br><br>
			</div>

			<button type="submit" name="login" id="auth-button">Login</button>
		</form>
		
		<p><a href="#" id="toggle-auth">Not registered? Click here to register</a></p>
		</div>
	</section>
	<section id="contact" style="background: black; color: white; font-size: large; text-align: center;">
			<br>
			<p> Contact us at:</p> 
			<p>Email: support@velocityvault.com</p> 
			<p>Phone: +918456789053</p> 
	</section>
    <script>
        document.getElementById("toggle-auth").addEventListener("click", function (e) {
            e.preventDefault();
            let registerFields = document.getElementById("register-fields");
            let authForm = document.getElementById("auth-form");
            let authButton = document.getElementById("auth-button");
            let formTitle = document.getElementById("form-title");

            if (registerFields.style.display === "none") {
                registerFields.style.display = "block";
                authButton.name = "register";
                authButton.innerText = "Register";
                formTitle.innerText = "Register";
            } else {
                registerFields.style.display = "none";
                authButton.name = "login";
                authButton.innerText = "Login";
                formTitle.innerText = "Login";
            }
        });
    </script>
</body>
</html>
