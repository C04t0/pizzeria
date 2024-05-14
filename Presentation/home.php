
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
                    <p class="importantInfo">
                        <caption class="important">!  IMPORTANT  !</caption><br>
                        <caption>
                            All pizzas are made with tomato sauce unless otherwise specified.
                            Cheese is a mixture of vegan cheese and edammer.
                        </caption><br>
                    </p>
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
                    <form method="post" action="pizzeria.php?action=addProduct">
                        <label for="productSelect">Choose a product: </label>
                        <select id="productSelect" name="productSelect">
                            <?php echo generateProductSelect($productList); ?>
                        </select>
                        <input type="submit" value="Add to shopping cart">
                    </form>
                </div>
            </section>
            <section id="bottomContent" class="bottom">
                <footer>
                    <p>
                        <h3>Check if we deliver to your address.</h3>
                    </p>
                    <form method="post" action="pizzeria.php?action=checkAddress">
                        <input type="text" value=""
                    </form>
                </footer>
            </section>
        </div>
    </body>
</html>
