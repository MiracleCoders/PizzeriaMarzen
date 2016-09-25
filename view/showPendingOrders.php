<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductOrder.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductMgmt.php";

$productOrder = new ProductOrder();
$products = $productOrder->showPendingOrders();

$productMgmt = new ProductMgmt(0, 0, 0);

foreach ($products as $product) {
    ?>
    <div class = "tile">
        <div class = "inner">
            <div class="form-shoppingCart">
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="value-orderID" value="<?php echo $product['id_order']; ?>">
                    <input type="hidden" name="value-statusID" value="<?php echo $product['id_status']; ?>">
                    <input type="submit" name="btn-changeOrderStatus" value="Zmień status">
                </form>
            </div>
            <div class="productTitle">
                Numer zamówienia: <?php echo $product['id_order']; ?>
            </div>
            <div class="productIngredients">
                <ul>
                    <?php
                    $allIngredients = $productMgmt->fetchProductIngredients($product['id_order']);
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
                Data zamówienia: <?php echo $product['date']; ?>
            </div>
            <div class="productDescription">
                Nazwa użytkownika: <?php echo $product['user_name']; ?>
            </div>
            <div class="productDescription">
                Nazwy produktów:
                <?php
                $orderdetails = $productOrder->getOrderDetails($product['id_order']);

                foreach ($orderdetails as $details) {
                    echo $details['name']."<br/>";
                }
                ?>

            </div>
            <div class="productPrice">
                Status: <?php echo $product['id_status']; ?>. <?php echo $product['status_name']; ?>
            </div>            
        </div>
    </div>
    <?php
}
echo "<pre>";
var_dump($products);
echo "</pre>";
