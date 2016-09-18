<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductMgmt.php";
$products = new ProductMgmt(0, 0, 0);
$allProducts = $products->fetchProducts();

foreach ($allProducts as $product) {
    ?>
    <div class = "tile">
        <div class = "inner">
            <div class="productTitle">
                <?php echo $product['name']; ?>
            </div>
            <div class="productIngredients">
                <ul>
                    <?php
                    $allIngredients = $products->fetchProductIngredients($product['id_product']);
                    $copy = $allIngredients;
                    foreach ($allIngredients as $ingredient) {
                        ?> 
                        <li> 
                            <?php
                            echo $ingredient['name'];
                            if (next($copy)) {
                                echo ',';
                            }
                            ?> 
                        </li> 
    <?php } ?>
                </ul>
            </div>
            <div class="productDescription">
                Opis: <?php echo $product['description']; ?>
            </div>
            <div class="productPrice">
                Cena: <?php echo $product['price']; ?> zł
            </div>
        </div>
    </div>
    <?php
}