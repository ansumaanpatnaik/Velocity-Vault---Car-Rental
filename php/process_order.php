<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_name = $_POST["car_name"];
    $customer_name = $_POST["name"];
    $email = $_POST["email"];
    $pickup_date = $_POST["pickup_date"];
    $return_date = $_POST["return_date"];
    $payment_method = $_POST["payment_method"];
    
    // Use prepared statement to prevent SQL injection
    // Prepare the SQL query
	$sql = "INSERT INTO orders (car_name,name, email, pickup_date, return_date, payment_method) 
			VALUES (?, ?, ?, ?, ?, ?)";

	$stmt = $conn->prepare($sql);

	// Check if the statement was prepared successfully
	if (!$stmt) {
		die("SQL Error: " . $conn->error);
	}

	$stmt->bind_param("ssssss", $car_name, $customer_name, $email, $pickup_date, $return_date, $payment_method);

	if ($stmt->execute()) {
		header("Location: ../html/order_success.html");
		exit();
	} else {
		die("Execution Error: " . $stmt->error);
	}

}

$conn->close();
?>
