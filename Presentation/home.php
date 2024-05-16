
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pizzeria Napolitana</title>
        <link rel="icon" href="../Presentation/img/pizza.png">
        <style> <?php include "Presentation/css/style.css"; ?></style>
    </head>
    <body>
        <div id="wrapper" class="container">
            <section id="topSection" class="top">
                <span id="titleSpan" class="title">
                    <h1>Pizzeria Napolitana</h1>
                </span>
                <nav id="topNav" class="navigation">
                    <a href="pizzeria.php?action=shoppingCart">Shopping Cart</a>
                    <a href="login.php">Log in</a>
                </nav>
            </section>
            <section id="middleContent" class="middle">
                <div id="pizzaMenu" class="menu">
                    <div class="importantInfo">
                        <h3 class="important">!  IMPORTANT  !</h3>
                    <caption><b>All pizzas are made with tomato sauce unless otherwise specified.</b></caption><br>
                    <caption><b>Cheese is a mixture of vegan cheese and emmentaler.</b></caption><br>
                    </div>
                    <table class="overview">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Promo</th>
                            <th>Seasonal code</th>
                        </tr>
                        <?php echo generateProductList($productList); ?>
                    </table>
                    <div id="accountNoAccount">
                        <button id="account" onclick="location.href='login.php'">I have an account</button>
                        <button id="noAccount" onclick="location.href='shoppingCart.php'">I don't have an acount</button>
                    </div>
                    <form method="post" action="pizzeria.php?action=addProduct">
                        <label for="productSelect">Choose a product: </label>
                        <select id="productSelect" name="productSelect">
                            <option selected value="">Choose here</option>
                            <?php echo generateProductSelect($productList); ?>
                        </select>
                        <input type="submit" value="Add to shopping cart">
                    </form>
                </div>
            </section>
            <section id="bottomContent" class="bottom">
                <footer>
                    <p>
                        <h3>Check if we deliver to your address!</h3>
                        <?php
                            echo generateErrors($error);
                            echo generateDeliverable($success);
                        ?>
                    </p>
                    <form method="post" action="pizzeria.php?action=checkAddress">
                        <label for="zipcode">Enter your zipcode</label>
                        <input type="text" name="zipcode">
                        <input type="submit" value="Check for delivery">
                    </form>
                </footer>
            </section>
        </div>
    </body>
</html>
