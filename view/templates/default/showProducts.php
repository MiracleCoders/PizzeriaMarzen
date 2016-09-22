<?php

require_once DIR_BASE. "/include/ProductMgmt.php";

$products = new ProductMgmt(0);
$allProducts = $products->fetchProducts();
?>
<span id="productsList">
    <?php
    foreach ($allProducts as $product) {
        ?>
        <div class = "tile">
            <div class = "inner">
                <?php echo $product['name']; ?>
            </div>
        </div>
        <?php
    }
    ?>
</span>
<?php
