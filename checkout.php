<?php
session_start();

// Dummy product data (replace with database retrieval)
$products = [
    1 => ['name' => 'Elegant Sculpture', 'price' => 45.00],
    2 => ['name' => 'Vintage Camera', 'price' => 75.00],
    // Add more products as needed
];

$subtotal = 0;
$shippingCost = 10.00;

// Retrieve cart data from the POST request
if (isset($_POST['cartData'])) {
    $cartData = json_decode($_POST['cartData'], true);

    if ($cartData) {
        // Calculate subtotal based on received cart data
        foreach ($cartData as $productId => $quantity) {
            if (isset($products[$productId])) {
                $subtotal += $products[$productId]['price'] * $quantity;
            }
        }
    }
} else {
    // If no cart data is received, you might want to handle this (e.g., redirect to cart)
    header("Location: cart.php");
    exit();
}

$totalAmount = $subtotal + $shippingCost;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Object Haven</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* ... (Your existing checkout.php styles) ... */
    </style>
</head>
<body>
    <header>
        <div class="logo">Object Haven</div>
        <nav>
            <ul>
                <li><a href="objects.php">Objects</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="cart.php">Cart (<?php echo isset($cartData) ? array_sum($cartData) : 0; ?>)</a></li>
            </ul>
        </nav>
    </header>
    <main class="bill-container">
        <div class="bill-header">
            <h2>Your Order Summary</h2>
            <p>Thank you for your order!</p>
        </div>

        <div class="bill-details">
            <h3>Shipping To:</h3>
            <p>Name: [Customer Name]</p>
            <p>Address: [Customer Address]</p>
        </div>

        <h3>Order Items:</h3>
        <table class="bill-items">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($cartData)) {
                    foreach ($cartData as $productId => $quantity) {
                        if (isset($products[$productId])) {
                            $product = $products[$productId];
                            $itemTotal = $product['price'] * $quantity;
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($product['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($quantity) . "</td>";
                            echo "<td>$" . number_format($product['price'], 2) . "</td>";
                            echo "<td>$" . number_format($itemTotal, 2) . "</td>";
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='4'>No items in cart.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="bill-total">
            Subtotal: $<?php echo number_format($subtotal, 2); ?><br>
            Shipping: $<?php echo number_format($shippingCost, 2); ?><br>
            <strong>Total Amount: $<?php echo number_format($totalAmount, 2); ?></strong>
        </div>

        <div class="thank-you">
            <p>Your order has been placed and will be processed shortly.</p>
        </div>

        <a href="objects.php" class="back-to-shop">Continue Shopping</a>
    </main>
    <footer>
        <p>&copy; 2025 Object Haven</p>
    </footer>
</body>
</html>