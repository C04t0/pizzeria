<?php

    declare(strict_types=1);
    spl_autoload_register();

    use Business\CustomerService;
    use Business\OrderService;

    require_once "Presentation/scripts/handlerScripts.php";
    require_once "Presentation/scripts/generateContent.php";

    $error = "";
    $success = null;
    $orderService = new OrderService();
    $customerService = new CustomerService();
    $customerList = $customerService->getAll();

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (!isset($_POST['email']) && !isset($_POST['password'])) {
        $_POST['email'] = null;
        $_POST['password'] = null;
    }
    if (isset($_SESSION['customer_id'])) {
        header("location: pizzeria.php");
        exit;
    } else {
        $id = checkCustomerCredentials($customerList, $_POST['email'], $_POST['password']);

        if (is_null($id)) {
            $error = "Invalid credentials";
        } else {
            $success = true;
            $_SESSION['customer_id'] = $id;
            $date = date("d-m-Y");
            $time = date("H:i");
            $_SESSION['order_id'] = $orderService->addOrder($id, $date, $time, "");
        }

        include "Presentation/loginForm.php";
    }

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        header("location: pizzeria.php");
        exit;
    }




