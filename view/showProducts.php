<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductMgmt.php";
$products = new ProductMgmt(0);
$allProducts = $products->fetchProducts();

foreach ($allProducts as $product) {
    ?>
    <div class = "tile">
        <div class = "inner">
                <?php echo $product['name'];?>
        </div>
    </div>
    <?php
}

