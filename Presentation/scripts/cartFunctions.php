<?php

    declare(strict_types=1);
    spl_autoload_register();

    use Business\OrderService;
    use Business\ProductService;

    $orderService = new OrderService();
    $productService = new ProductService();

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    function addToCart($productId, $amount): void {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $amount;
        } else {
            $_SESSION['cart'][$productId] = $amount;
        }
    }
    function removeFromCart($productId): void {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }
    function getAllCartItems() {
        return $_SESSION['cart'] ?? [];
    }
    function getTotalPrice(): float {
        $total = 0;
        global $productService;
        $cart = getAllCartItems();

        foreach ($cart as $productId => $amount) {
            $price = $productService->getProduct($productId)->getPrice();
            $total += $price * $amount;
        }
        return $total;
    }
    function placeOrder($customerId): int {
        global $orderService;
        global $productService;
        $date = date("d-m-Y");
        $time = date("H:i");
        $remark = $_POST['remark'] ?? "";
        $extra = $_POST['extra'] ?? "";

        $orderId = $orderService->addOrder($customerId, $date, $time, $remark);

        $cart = getAllCartItems();
        foreach ($cart as $productId => $amount) {
            $price = $productService->getProduct($productId)->getPrice();
            $orderService->addOrderLine(
                (int)$orderId,
                (int)$productId,
                $amount,
                $price,
                $extra
            );
        }

        $_SESSION['cart'] = [];

        return (int)$orderId;
    }
