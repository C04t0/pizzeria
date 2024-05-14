<?php
    declare(strict_types=1);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Shopping Cart</title>
        <link rel="icon" href="../Presentation/img/pizza.png">
        <style> <?php include "Presentation/css/style.css"; ?></style>
    </head>
    <body>
        <div id="wrapper" class="container">
            <section id="topSection" class="top">
                <nav id="topNav" class="navigation">
                    <a href="pizzeria.php?action=return">Return to main menu</a>
                    <a href="pizzeria.php?action=login">Log in</a>
                </nav>
            </section>
            <section id="middleContent" class="middle">
                <table id="cartOverview" class="overview">
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Extra</th>
                        <th>Total</th>
                    </tr>
                    <?php generateShoppingCart($orderLines); ?>
                </table>
            </section>
            <section id="bottomContent" class="bottom">
                <footer>
                    <form method="post" action="pizzeria.php?action=checkout">
                        <input type="submit" value="Checkout">
                    </form>
                </footer>
            </section>
        </div>
    </body>
</html>
