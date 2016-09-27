<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductOrder.php";
$order = new ProductOrder();
$products = $order->getCart();

if (empty($products)) {
    echo "Twój koszyk jest pusty.";
} else {
    foreach ($products as $product) {
        foreach ($product as $specifiedProduct) {
            ?>
            <div class = "tile">
                <div class = "inner">
                    <div class="productTitle">
                        <?php echo $product[0]['name']; ?>
                    </div>
                    <div class="productIngredients">

                    </div>
                    <div class="productDescription">
                        Opis: <?php echo $product[0]['description']; ?>
                    </div>
                    <div class="productPrice">
                        Cena: <?php echo $product[0]['price']; ?> zł
                    </div>            
                </div>
            </div>
            <?php
            //  echo $specifiedProduct[0]['name'];
        }
    }
    ?>
    <div class="form-shoppingCart">
        <form action="index.php" method="POST" enctype="multipart/form-data">
            Imię <input type="text" name="txt-name">
            Nazwisko <input type="text" name="txt-lastName">
            <input type="submit" name="btn-finalizeOrder" value="Złóż zamówienie">
        </form>
    </div>
    <?php
}