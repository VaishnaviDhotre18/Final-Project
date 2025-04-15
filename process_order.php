<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic validation
    if (empty($_POST['name']) || empty($_POST['address'])) {
        echo "Please fill in all required shipping information.";
        exit();
    }

    // Here you would typically:
    // 1. Validate user data
    // 2. Save the order details to your database
    // 3. Process payment (if a real gateway was integrated)
    // 4. Clear the shopping cart (session)
    // 5. Send confirmation email to the user

    // For this simulation, we'll just display a success message and clear the cart
    echo "<h2>Order Placed Successfully!</h2>";
    echo "<p>Thank you for your order, " . htmlspecialchars($_POST['name']) . "!</p>";
    echo "<p>Your order will be shipped to:</p>";
    echo "<pre>" . htmlspecialchars($_POST['address']) . "</pre>";

    // Clear the cart
    $_SESSION['cart'] = [];

    echo "<p><a href='objects.php'>Continue Shopping</a></p>";
} else {
    // If someone tries to access this page directly without submitting the form
    header("Location: checkout.php");
    exit();
}
?>