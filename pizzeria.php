<?php

    declare(strict_types=1);
    spl_autoload_register();

    use Business\AddressService;
    use Business\CustomerService;
    use Business\OrderService;
    use Business\ProductService;
    require_once "Presentation/scripts/handlerScripts.php";
    require_once "Presentation/scripts/generateContent.php";

    $error = null;
    $success = null;
    $orderService = new OrderService();
    $addressService = new AddressService();
    $productService = new ProductService();
    $customerService = new CustomerService();

    $productList = $productService->getAllProducts();

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'return':
                include 'Presentation/home.php';
                break;
            case 'shoppingCart':
                $orderLines = $orderService->getAllOrderLinesFromOrder($_SESSION['orderId']);
                include "Presentation/shoppingCart.php";
                break;
            case 'checkAddress':
                $deliverable = checkDeliveryAddress($_POST['zipcode']);
                if (!$deliverable) {
                    $error = "We're sorry for the inconvenience. At this time we do not deliver to your city.";
                } else {
                    $success = true;
                }
                include "Presentation/home.php";
                break;
            case 'login':
                include 'Presentation/loginForm.php';
                break;
        }
    } else {
        include 'Presentation/home.php';
    }