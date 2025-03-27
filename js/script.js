document.addEventListener("DOMContentLoaded", function () {
    // Toggle Login/Register Fields
    let toggleAuth = document.getElementById("toggle-auth");
    if (toggleAuth) {
        toggleAuth.addEventListener("click", function (e) {
            e.preventDefault();
            let registerFields = document.getElementById("register-fields");
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
    }

    // Auto-Fill Checkout Fields If Logged In
    let nameField = document.getElementById("name");
    let emailField = document.getElementById("email");
    if (nameField && emailField) {
        fetch("session_check.php")
            .then(response => response.json())
            .then(data => {
                if (data.loggedIn) {
                    nameField.value = data.name;
                    emailField.value = data.email;
                }
            });
    }

    // Update Cost on Car Selection Change
    let carSelection = document.getElementById("car-selection");
    if (carSelection) {
        carSelection.addEventListener("change", function () {
            let selectedText = carSelection.options[carSelection.selectedIndex].text;
            let cost = selectedText.split("->")[1].trim();
            document.getElementById("cost-display").textContent = cost;
        });
    }

    // Validate Checkout Form
    let checkoutForm = document.getElementById("checkout-form");
    if (checkoutForm) {
        checkoutForm.addEventListener("submit", function (event) {
            let name = document.getElementById("name").value.trim();
            let email = document.getElementById("email").value.trim();
            let pickupDate = document.getElementById("pickup-date").value;
            let returnDate = document.getElementById("return-date").value;
            let paymentMethod = document.getElementById("payment-method").value;

            if (!name || !email || !pickupDate || !returnDate || !paymentMethod) {
                alert("Please fill in all fields.");
                event.preventDefault();
            }

            if (new Date(pickupDate) > new Date(returnDate)) {
                alert("Return date must be after the pickup date.");
                event.preventDefault();
            }
        });
    }
});


