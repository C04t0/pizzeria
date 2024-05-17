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
            $product = $productService->getProduct($productId);
            if (empty($product)) {
                echo "<tr>"
                    . "<td colspan='6' class='error'>Your cart is empty!</td>"
                    . "</tr>";
                exit;
            } else {
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
                . "' name='product_id'>"
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
                    . "<button id='account' type='submit' name='account' value='account' onclick="
                    . $loginLink
                    . ">I have an account</button>"
                    . "<button id='noAccount' type='submit' name='account' value='noAccount' onclick="
                    . $shoppingCartLink
                    . ">I don't have an acount</button>"
                    . "</div>";
        }

        return ob_get_clean();
    }
    function generateAddressInfo($account): ?string {
        ob_start();

        if ($account === "noAccount") {
           echo "<label for='addressInfo'>Please enter the delivery address: </label>"
                    . "<form id='addressInfo' method='post' action='cart.php?action=addressInfo'>"
                    . "<label for='name'>Name: </label>"
                    . "<input type='text' id='name' name='name' required>"
                    . "<label for='lastName'>Last name: </label>"
                    . "<input type='text' id='lastName' name='lastName'>"
                    . "<label for='street'>Street: </label>"
                    . "<input type='text' id='street' name='street' required>"
                    . "<label for='houseNumber'>House number:</label>"
                    . "<input type='number' id='houseNumber' name='houseNumber' required>"
                    . "<label for='bus'>Bus: </label>"
                    . "<input type='text' id='bus' name='bus'>"
                    . "<label for='postalCode'>Postal code: </label>"
                    . "<input type='text' id='postalCode' name='postalCode' required>"
                    . "<label for='city'>City: </label>"
                    . "<input type='text' id='city' name='city' required>"
                    . "</form>";
        }

        return ob_get_clean();
    }
