<?php
session_start(); 

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addToCart') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $_SESSION['cart'][] = ['name' => $name, 'price' => $price];

    $cartCount = count($_SESSION['cart']);
    echo json_encode(['status' => 'success', 'message' => "$name added to cart!", 'cartCount' => $cartCount]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
    <style>
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 14px;
        }
        .navbar-nav .nav-link {
            position: relative;
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">My Store</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart <span id="cart-count" class="cart-count" style="display: none;">0</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">Description of Product 1.</p>
                        <p class="card-text">$10.00</p>
                        <button class="btn btn-primary add-to-cart" data-name="Product 1" data-price="10.00">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">Description of Product 2.</p>
                        <p class="card-text">$15.00</p>
                        <button class="btn btn-primary add-to-cart" data-name="Product 2" data-price="15.00">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">Description of Product 3.</p>
                        <p class="card-text">$20.00</p>
                        <button class="btn btn-primary add-to-cart" data-name="Product 3" data-price="20.00">Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product 4</h5>
                        <p class="card-text">Description of Product 4.</p>
                        <p class="card-text">$25.00</p>
                        <button class="btn btn-primary add-to-cart" data-name="Product 4" data-price="25.00">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addToCart(name, price) {
            $.post('index.php', {
                action: 'addToCart',
                name: name,
                price: price
            }, function(response) {
                const result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message);
                    $('#cart-count').text(result.cartCount).show();
                }
            });
        }

        $(document).ready(function() {
            $('.add-to-cart').on('click', function() {
                const productName = $(this).data('name');
                const productPrice = $(this).data('price');
                addToCart(productName, productPrice);
            });

            $.get('index.php', { action: 'getCartCount' }, function(response) {
                const result = JSON.parse(response);
                if (result.status === 'success') {
                    $('#cart-count').text(result.cartCount).show();
                }
            });
        });
    </script>
</body>
</html>
