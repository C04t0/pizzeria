<?php

    declare(strict_types=1);
    spl_autoload_register();

    use Business\CustomerService;
    require_once "Presentation/scripts/handlerScripts.php";

    $error = null;
    $customerService = new CustomerService();
    $customerList = $customerService->getAll();

    if (isset($_SESSION['customer_id'])) {
        header("location: pizzeria.php");
        exit;
    } else {
        $id = checkCustomerCredentials($customerList, $_POST['email'], $_POST['password']);

        if (is_null($id)) {
            $error = "Invalid credentials";
            include "Presentation/loginForm.php";
        } else {
            $_SESSION['customer_id'] = $id;
            header("location: pizzeria.php");
            exit;
        }
    }

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        header("location: pizzeria.php");
        exit;
    }




