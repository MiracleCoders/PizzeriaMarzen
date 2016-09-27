<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductOrder.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductMgmt.php";

$productOrder = new ProductOrder();
$products = $productOrder->showPendingOrders();

$productMgmt = new ProductMgmt(0, 0, 0);

foreach ($products as $product) {
    ?>
    <div class = "tile taller tileColor1" style="background-color: <?php echo $product['color'] ?>">
        <div class = "inner">
            <div class="form-shoppingCart">
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="value-orderID" value="<?php echo $product['id_order']; ?>">
                    <input type="hidden" name="value-statusID" value="<?php echo $product['id_status']; ?>">
                    <?php
                    if ($product['id_status'] > 1) {
                        ?>
                        <input type="submit" name="btn-prevOrderStatus" value="Poprzedni status">
                    <?php } ?>

                    <?php if ($product['id_status'] < 5) { ?>
                        <input type="submit" name="btn-nextOrderStatus" value="Następny status">
                    <?php } else {
                        ?>                        
                        <input type="submit" name="btn-nextOrderStatus" class="finishOrder" value="Zakończ">
                        <?php
                    }
                    ?>
                </form>
            </div>
            <div class="productTitle">
                Numer zamówienia: <?php echo $product['id_order']; ?>
            </div>
            <div class="productIngredients indent">
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
            <div class="productDescription indent">
                Data zamówienia: <?php echo $product['date']; ?>
            </div>
            <div class="productDescription indent">
                Nazwa użytkownika: <?php echo $product['user_name']; ?>
            </div>
            <div class="productDescription indent">
                Nazwy produktów:
                <?php
                $orderdetails = $productOrder->getOrderDetails($product['id_order']);

                foreach ($orderdetails as $details) {
                    echo $details['name'] . "<br/>";
                }
                ?>

            </div>
            <div class="productPrice indent">
                Status: <?php echo $product['id_status']; ?>. <?php echo $product['status_name']; ?>
            </div>            
        </div>
    </div>
    <?php
}
//echo "<pre>";
//var_dump($products);
//echo "</pre>";

    