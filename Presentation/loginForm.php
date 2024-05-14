<?php
    declare(strict_types=1);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pizzeria Login</title>
        <link rel="icon" href="img/pizza.png">
        <style> <?php include "Presentation/css/style.css"; ?></style>
    </head>
    <body>
        <div id="wrapper" class="container">
            <section id="topSection" class="top">
                <nav id="topNav" class="navigation">
                    <a href="pizzeria.php?action=return">Return to main menu</a>
                    <a href="pizzeria.php?action=shoppingCart">Shopping Basket</a>
                </nav>
            </section>
            <section id="middleContent" class="middle">
                <form method="post" action="../pizzeria.php?action=login">
                    <label for="email">Email address: </label>
                    <input type="text" id="email" name="email" required><br>
                    <label for="password">Password: </label>
                    <input type="password" id="password" name="password" required><br>
                    <input type="submit" value="Login">
                </form>
                <?php echo generateErrors($error); ?>
            </section>
            <section id="bottomContent" class="bottom">
                <button onclick="location.href='login.php?action=logout'" value="Logout"></button>
            </section>
        </div>
    </body>
</html>