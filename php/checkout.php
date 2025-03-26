<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Car Rental</title>
    <link rel="stylesheet" href="../css/style_checkout.css">
	<script src="../js/script.js"></script>
</head>
<body>

    <header>
        <a id="logoid" href="../php/index.php"><div class="logo">VELOCITY VAULT</div></a>
        <nav>
            <ul>
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

    <section class="checkout-container">

        <form action="process_order.php" method="POST">
			<h2>Select Your Car:</h2>
        
			<label for="car-selection">Choose a Car:</label>
			<select id="car-selection" name="car_name" onchange="updateCost()">
				<option value="Luxury Sedan">Luxury Sedan -> 300000/day</option>
				<option value="Pagani Huayra">Pagani Huarya -> 550000/day</option>
				<option value="Mercedes G-Wagon">Mercedes G Wagon -> 425000/day</option>
				<option value="Bugatti Chiron">Bugatti Chiron -> 500000/day</option>
				<option value="Audi A1">Audi A1 -> 475000/day</option>
				<option value="Mc Laren P1">Mc Laren P1 -> 500000/day</option>
				<option value="Ferrari 812GTS">Ferrari 812GTS -> 575000/day</option>
				<option value="Rolls Royce Boat-Tail">Rolls Royce Boat-Tail -> 525000/day</option>
				<option value="Aston Martin Valkyrie">Aston Martin Valkyrie -> 445000/day</option>
				<option value="Bentley Bentayga">Bentley Bentayga -> 375000/day</option>
				
			</select>
            <label for="name">Full Name:</label>
			<input type="text" id="name" name="name" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" required>

			<label for="email">Email:</label>
			<input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>


            <label for="pickup-date">Pickup Date:</label>
            <input type="date" id="pickup-date" name="pickup_date" required>

            <label for="return-date">Return Date:</label>
            <input type="date" id="return-date" name="return_date" required>

            <label for="payment-method">Payment Method:</label>
            <select id="payment-method" name="payment_method" required onchange="togglePaymentInput()">
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cash">Cash on Pickup</option>
            </select>
			
			<!-- Credit Card Section -->
			
			<div id="credit-card-section">
				<label for="card-number">Card Number:</label>
				<input type="text" id="card-number" name="card_number" maxlength="19" placeholder="XXXX XXXX XXXX XXXX" >

				<label for="expiry-date">Expiry Date:</label>
				<input type="month" id="expiry-date" name="expiry_date" >

				<label for="cvv">CVV:</label>
				<input type="text" id="cvv" name="cvv" maxlength="3" placeholder="123" >
			</div>
			
			<!-- PayPal Section -->
			<div id="paypal-section">
				<label for="paypal-email">PayPal Email:</label>
				<input type="email" id="paypal-email" name="paypal_email" placeholder="your-email@example.com" >
			</div>
	
			<p>Cost per day: <span id="cost-display"> 300000/day</span></p>
			<button type="submit">Place Order</button>
		</form>
    </section>
	<section id="contact" style="background: black; color: white; font-size: large; text-align: center;">
			<br>
			<p> Contact us at:</p> 
			<p>Email: support@carrental.com</p> 
			<p>Phone: +123 456 7890</p> 
	</section>
    <script>

	//Hide extra payment mode input fields
	document.addEventListener("DOMContentLoaded", function () {
	    let paymentMethod = document.getElementById("payment-method");
	    let cardSection = document.getElementById("credit-card-section");
	    let paypalSection = document.getElementById("paypal-section");
	
	    function togglePaymentInput() {
	        let selectedMethod = paymentMethod.value;
	
	        if (selectedMethod === "credit_card") {
	            cardSection.style.display = "block";
	            paypalSection.style.display = "none";
	        } else if (selectedMethod === "paypal") {
	            paypalSection.style.display = "block";
	            cardSection.style.display = "none";
	        } else {
	            cardSection.style.display = "none";
	            paypalSection.style.display = "none";
	        }
	    }

	    if (paymentMethod) {
	        paymentMethod.addEventListener("change", togglePaymentInput);
	        togglePaymentInput(); // Run on page load
	    }
	});

        // Set today's date as the minimum for pickup
        document.addEventListener("DOMContentLoaded", function () {
            let today = new Date().toISOString().split("T")[0];
            document.getElementById("pickup-date").setAttribute("min", today);
            document.getElementById("return-date").setAttribute("min", today);
        });

        // Validate form before submission
        function validateForm() {
            let name = document.getElementById("name").value.trim();
            let email = document.getElementById("email").value.trim();
            let pickupDate = document.getElementById("pickup-date").value;
            let returnDate = document.getElementById("return-date").value;

            if (!name || !email || !pickupDate || !returnDate) {
                alert("Please fill in all fields.");
                return false;
            }

            if (new Date(pickupDate) > new Date(returnDate)) {
                alert("Return date must be after the pickup date.");
                return false;
            }

            alert("Order placed successfully!");
            return true;
        }
    </script>

</body>
</html>
