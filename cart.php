<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['cart'] = [];
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">My Store</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Products</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Your Cart</h2>
        <ul class="list-group mt-3">
            <?php if (empty($cart)): ?>
                <li class="list-group-item">Your cart is empty.</li>
            <?php else: ?>
                <?php foreach ($cart as $item): ?>
                    <li class="list-group-item"><?= htmlspecialchars($item['name']) ?> - $<?= htmlspecialchars($item['price']) ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <?php if (!empty($cart)): ?>
            <form method="post" class="mt-3">
                <button type="submit" class="btn btn-primary">Pay</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
