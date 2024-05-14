<?php

    declare(strict_types=1);
    spl_autoload_register();
    session_start();

    use Business\AddressService;
    use Business\CustomerService;
    use Business\OrderService;
    use Business\ProductService;
    require_once "Presentation/scripts/handlerScripts.php";
    require_once "Presentation/scripts/generateContent.php";

    $orderService = new OrderService();
    $addressService = new AddressService();
    $productService = new ProductService();
    $customerService = new CustomerService();

    $productList = $productService->getAllProducts();

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'return':
                include 'Presentation/home.php';
                break;
            case 'shoppingCart':
                $orderLines = $orderService->getAllOrderLinesFromOrder(1);
                include "Presentation/shoppingCart.php";
                break;
            case 'checkAddress':
                $deliverable = checkDeliveryAddress($_POST['city_id']);
                include "Presentation/home.php";
                break;
        }
    } else {
        include 'Presentation/home.php';
    }