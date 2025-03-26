<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "car_rental");

$user_id = $_SESSION['user_id'];
$sql_history = "SELECT car_name, pickup_date, return_date FROM orders WHERE email = ?";
$stmt = $conn->prepare($sql_history);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style_dashboard.css">
</head>
<body>
    <header>
        <a id="logoid" href="index.php"><div class="logo">VELOCITY VAULT</div></a>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1>
        <p>Track your rentals below</p> <br>
		<div class="history">
			<table border="1">
				<tr><th>Car Name</th><th>Pickup Date</th><th>Return Date</th></tr>
				<?php while ($row = $result->fetch_assoc()) {
					echo "<tr><td>{$row['car_name']}</td><td>{$row['pickup_date']}</td><td>{$row['return_date']}</td></tr>";
				} ?>
			</table>
		</div>
    </section>
	<section id="contact" style="background: black; color: white; font-size: large; text-align: center;">
			<br>
			<p> Contact us at:</p> 
			<p>Email: support@carrental.com</p> 
			<p>Phone: +123 456 7890</p> 
	</section>
</body>
</html>
