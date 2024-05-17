<?php

    declare(strict_types=1);
    spl_autoload_register();

    use Business\CustomerService;
    use Business\OrderService;

    require_once "Presentation/scripts/handlerScripts.php";
    require_once "Presentation/scripts/generateContent.php";

    $error = null;
    $success = false;
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

        if (!$id) {
            $error = "Invalid credentials";
        } else {
            $success = "login";
            $_SESSION['customer_id'] = $id;
        }

        include "Presentation/loginForm.php";
    }

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        $success = "You have been successfully logged out.";
    }




