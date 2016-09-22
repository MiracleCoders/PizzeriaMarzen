<?php

require_once "./include/ProductMgmt.php";

if (isset($_POST['btn-productMgmt'])) {
    if (!isset($_SESSION['productMgmt'])) {
        $_SESSION['productMgmt'] = true;
    } else {
        $_SESSION['productMgmt'] = $_SESSION['productMgmt'] == true ? false : true;
    }
}

if (isset($_POST['btn-addProduct']) && $_POST['productName'] != "") {
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];
    $product = new ProductMgmt($name, $price, $description);
    
    $product->getIngredients();
    $product->insertProduct();

    header("Location:  ./index.php");
    //header("Location:  ./view/productMgmt.php");
    ?>
    <script type="text/javascript">
        removeDOMElement("#form-productMgmt");
        if (!$("#form-productMgmt")[0])
            createDOMElement(".mainContent", "form-productMgmt", "./view/productMgmt.php");
    </script>
    <?php

}
