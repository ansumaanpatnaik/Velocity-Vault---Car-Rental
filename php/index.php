<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velocity Vault</title>
    <link rel="stylesheet" href="../css/styles.css">
	
</head>
<body>
	<script src="../js/script.js"></script>
    <header>
        <a id="logoid" href="../php/index.php"><div class="logo">VELOCITY VAULT</div></a>
        <nav>
            <ul>
                <!---<li><a href="../html/fleet-section.html">Fleet</a></li>--->
                <li><a href="#contact">Contact Us</a></li>
				<?php
					session_start();
					if (isset($_SESSION['user_id'])) {
						echo '<li><a href="dashboard.php">My Dashboard</a></li>';
					} else {
						echo '<li><a href="login.php">Login</a></li>';
					}
				?>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h1>VELOCITY VAULT</h1> <br>
        <p>Find the perfect car for your trip.</p> <br>
        <!--<form action="process_booking.php" method="POST">
		<input type="text" name="location" placeholder="Pickup Location" required>
		<input type="date" name="pickup" required>
		<input type="date" name="dropoff" required>
		<button type="submit">BOOK NOW</button>
		</form>--> <br>
		<button class="book-btn" onclick="scrollToFleet()">Check Our Fleet</button>
	</section>

    <section id="fleet-section" class="fleet">
        <h2>OUR FLEET</h2> <br>
        <div class="car-container">
            <div class="car">
                <img src="../img/car1.jpg" alt="Luxury Car">
                <h3>Luxury Sedan</h3>
                <p>300,000/day</p>
            </div>
            <div class="car">
                <img src="../img/car2.jpg" alt="SUV">
                <h3>Mercedes G-Wagon</h3>
                <p>425,000/day</p>
            </div>
            <div class="car">
                <img src="../img/car3.jpg" alt="Sports Car">
                <h3>Mc Laren P1</h3>
                <p>500,000/day</p>
            </div>
			<div class="car">
                <img src="../img/car4.jpg" alt="Sports Car">
                <h3>Ferrari 812GTS</h3>
                <p>575,000/day</p>
            </div>
			<div class="car">
                <img src="../img/car5.jpg" alt="Sports Car">
                <h3>Audi A1</h3>
                <p>475,000/day</p>
            </div>
        </div>
    </section>
	
	<section id="fleet-section" class="fleet">
        <div class="car-container">
            <div class="car">
                <img src="../img/car6.jpg" alt="Luxury Car">
                <h3>Bentley Bentayga</h3>
                <p>375,000/day</p>
        </div>
		<div class="car">
                <img src="../img/car7.jpg" alt="Luxury Car">
                <h3>Aston Martin Valkyrie</h3>
                <p>445,000/day</p>
        </div>
		<div class="car">
                <img src="../img/car8.jpg" alt="Luxury Car">
                <h3>Rolls Royce Boat-Tail</h3>
                <p>525,000/day</p>
        </div>
		<div class="car">
                <img src="../img/car9.jpg" alt="Luxury Car">
                <h3>Bugatti Chiron</h3>
                <p>500,000/day</p>
        </div>
		<div class="car">
                <img src="../img/car10.jpg" alt="Luxury Car">
                <h3>Pagani Huayra</h3>
                <p>550,000/day</p>
        </div>
	</section>
		<script> function scrollToFleet() {
		document.getElementById("fleet-section").scrollIntoView({ behavior: "smooth" });
		}
		</script>
		
		<section class="checkout-section">
		<button class="checkout-btn" onclick="window.location.href='../php/checkout.php'">
			Book Now!
		</button>
	</section>
	<section id="contact" style="background: black; color: white; font-size: large; text-align: center;">
			<br>
			<p> Contact us at:</p> 
			<p>Email: support@velocityvault.com</p> 
			<p>Phone: +918456789053</p> 
	</section>
	
</body>
</html>
