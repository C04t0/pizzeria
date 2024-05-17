<?php

    declare(strict_types=1);

    use Business\ProductService;

    include 'Presentation/scripts/cartFunctions.php';

    $productService = new ProductService();
    $productList = $productService->getAllProducts();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'add':
                $productId = (int)$_POST['product_id'];
                $quantity = (int)$_POST['amount'];
                addToCart($productId, $quantity);
                include "Presentation/shoppingCart.php";
                break;
            case 'remove':
                $productId = (int)$_POST['productId'];
                removeFromCart($productId);
                include "Presentation/shoppingCart.php";
                break;
            case 'checkout':
                $customerId = $_SESSION['customerId'];
                $orderId = placeOrder($customerId);
                include "Presentation/shoppingCart.php";
                break;
        }
    } else {
        include "Presentation/shoppingCart.php";
    }