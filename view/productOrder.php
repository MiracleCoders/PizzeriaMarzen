<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductOrder.php";
$order = new ProductOrder();
$products = $order->getCart();

foreach ($products as $product) {
    foreach ($product as $specifiedProduct) { ?>
        <div class = "tile">
            <div class = "inner">
                <div class="form-shoppingCart">
                    <form action="index.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="value-productID" value="<?php echo $product[0]['id_product']; ?>">
                        <input type="submit" name="btn-deleteFromCart" value="Usuń">
                    </form>
                </div>
                <div class="productTitle">
                    <?php echo $product[0]['name']; ?>
                </div>
                <div class="productIngredients">

                    </ul>
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
        echo $specifiedProduct[0]['name'];
    }
}
