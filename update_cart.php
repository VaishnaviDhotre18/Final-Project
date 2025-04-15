<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quantity'])) {
    $quantities = $_POST['quantity'];

    // Loop through the submitted quantities and update the cart
    foreach ($quantities as $productId => $qty) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] = max(1, intval($qty)); // Ensure quantity is at least 1 and an integer
        }
    }

    // Redirect back to the cart page
    header("Location: cart.php");
    exit();
} else {
    // If the script is accessed directly or without POST data, redirect to the cart page
    header("Location: cart.php");
    exit();
}
?>