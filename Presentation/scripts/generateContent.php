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
    function generateShoppingCart($orderLines): ?string {
        $totalPrice = 0;
        global $productService;
        ob_start();

        if (is_null($orderLines)) {
            echo "<tr>"
                    . "<td colspan='6'>You haven't added anything to the order yet.</td>"
                    . "</tr>";
        } else {
            foreach ($orderLines as $orderLine) {
                $totalPrice += ($orderLine->getAmount() * $orderLine->getPrice());
                echo "<tr>"
                    . "<td>" . $productService->getProduct($orderLine->getProductId())->getName() . "</td>"
                    . "<td>" . $orderLine->getAmount() . "</td>"
                    . "<td>" . $orderLine->getPrice() . "</td>"
                    . "<td>" . $orderLine->getAmount() * $orderLine->getPrice() . "</td>"
                    . "<td>" . $orderLine->getExtra() . "</td>"
                    . "</tr>";
            }
            echo "<tr>"
                . "<td colspan='6'>" . $totalPrice . "</td>"
                . "</tr>";
        }

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