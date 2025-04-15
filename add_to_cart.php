<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Basic validation
    if (!is_numeric($productId) || !is_numeric($quantity) || $quantity < 1) {
        header("Location: objects.php?error=invalid_input"); // Redirect with error
        exit();
    }

    // In a real application, you would fetch product details from the database here
    $products = [
        1 => ['name' => 'Elegant Sculpture', 'price' => 45.00],
        2 => ['name' => 'Vintage Camera', 'price' => 75.00],
        // ... more products
    ];

    if (isset($products[$productId])) {
        $product = $products[$productId];

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += $quantity; // Increment quantity if already in cart
        } else {
            $_SESSION['cart'][$productId] = [
                'quantity' => $quantity,
                'name' => $product['name'],
                'price' => $product['price']
            ];
        }

        header("Location: cart.php?success=added"); // Redirect to cart with success message
        exit();
    } else {
        header("Location: objects.php?error=product_not_found"); // Redirect with error
        exit();
    }
} else {
    // If accessed directly
    header("Location: objects.php");
    exit();
}
?>