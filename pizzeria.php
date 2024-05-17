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
    $account = false;
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
            case 'addProduct':
                if (!isset($_SESSION['customer_id'])) {
                    $account = true;
                }
                include "Presentation/home.php";
                break;
            case 'return':
                include 'Presentation/home.php';
                break;
            case 'shoppingCart':
                header("Location: cart.php");
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
                header("Location: login.php");
                break;
        }
    } else {
        include 'Presentation/home.php';
    }