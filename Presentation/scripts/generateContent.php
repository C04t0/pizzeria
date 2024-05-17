<?php

    declare(strict_types=1);

    function generateProductList($productList): ?string {
        ob_start();

        foreach ($productList as $product) {
            $promoId = $product->getPromoId();
            $seasonId = $product->getSeasonId();

            if ($promoId == 0) {
                $promoId = "None";
            }
            if ($seasonId == 0) {
                $seasonId = "None";
            }
            echo "<tr>"
                    . "<td>" . $product->getName() . "</td>"
                    . "<td>" . $product->getDescription() . "</td>"
                    . "<td>" . $product->getPrice() . "</td>"
                    . "<td>" . $promoId . "</td>"
                    . "<td>" . $seasonId . "</td>"
                    . "</tr>";
        }

        return ob_get_clean();
    }
    function generateShoppingCart(): ?string {
        global $productService;
        $cart = getAllCartItems();
        $totalPrice = getTotalPrice();
        $extra = "";
        ob_start();

        foreach ($cart as $productId => $amount) {
            if ($productId === 0) {
                echo "<tr>"
                    . "<td colspan='6'>You haven't added anything to the order yet.</td>"
                    . "</tr>";
            } else {
                $product = $productService->getProduct($productId);
                echo "<tr>"
                    . "<td>" . $product->getName() . "</td>"
                    . "<td>" . $amount . "</td>"
                    . "<td>" . $product->getPrice() . "</td>"
                    . "<td>" . $amount * $product->getPrice() . "</td>"
                    . "<td>" . $extra . "</td>"
                    . "</tr>";
            }
        }
            echo "<tr>"
                . "<td colspan='6'>" . $totalPrice . "</td>"
                . "</tr>";

        return ob_get_clean();
    }
    function generateProductSelect($productList): ?string {
        ob_start();

        foreach ($productList as $product) {
            echo "<option value='"
                . $product->getId()
                . "'>"
                . $product->getName()
                . "</option>";
        }

        return ob_get_clean();
    }
    function generateErrors($error): ?string {
        ob_start();

        if (!is_null($error)) {
            echo "<p class='error'>" . $error . "</p>";
        }

        return ob_get_clean();
    }
    function generateDeliverable($success): ?string {
        ob_start();

        if (!is_null($success)) {
            echo "<p class='success'>We deliver to your city!</p>";
        }

        return ob_get_clean();
    }
    function generateLoginSuccess($success): ?string {
        ob_start();

        if ($success == "login") {
            echo "<p class='success'>You have been successfully logged in!</p>";
        }
        if ($success == "You have been successfully logged out.") {
            echo "<p class='success'>You have been successfully logged out!</p>";
        }
        return ob_get_clean();
    }
    function generateLogout($success): ?string {
        ob_start();

        if ($success) {
            echo "<button onclick=location.href='login.php?action=logout' value='Logout'>Logout</button>";
        }

        return ob_get_clean();
    }
    function generateAccountNoAccount($account): ?string {
        $loginLink = 'location.href="login.php"';
        $shoppingCartLink = 'location.href="cart.php"';
        ob_start();

        if ($account) {
            echo "<div id='accountNoAccount'>"
                    . "<h4 class='error'>Please log in first if you have an account!</h4>"
                    . "<button id='account' onclick=" . $loginLink . ">I have an account</button>"
                    . "<button id='noAccount' onclick=" . $shoppingCartLink . ">I don't have an acount</button>"
                    . "</div>";
        }

        return ob_get_clean();
    }
