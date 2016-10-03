<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductOrder.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/userData.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/userService.php";
$order = new ProductOrder();
$products = $order->getCart();

if (empty($products)) {
    echo "Twój koszyk jest pusty.";
} else {
    $userData = new userData();
    $userService = new userService($userData);

    $userDetails = $userService->getUserDetails($_SESSION['userId']);
    
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
    <div class="form-finalizeOrder">
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <div class="input-Wrapper">
                Imię <input type="text" name="txt-name" value="<?php if(isset($userDetails[0])) echo $userDetails[0]['name'] ?>">
            </div>
            <div class="input-Wrapper">
                Nazwisko <input type="text" name="txt-lastName" value="<?php if(isset($userDetails[0])) echo $userDetails[0]['lastName'] ?>">
            </div>

            <div class="input-Wrapper">
                Nr telefonu <input type="text" name="txt-phoneNumber" value="<?php if(isset($userDetails[0])) echo $userDetails[0]['phoneNumber'] ?>">
            </div>

            <div class="input-Wrapper">
                Miasto <input type="text" name="txt-city" value="<?php if(isset($userDetails[0])) echo $userDetails[0]['city'] ?>">
            </div>

            <div class="input-Wrapper">
                Kod pocztowy <input type="text" name="txt-postalCode" value="<?php if(isset($userDetails[0])) echo $userDetails[0]['postalCode'] ?>">
            </div>

            <div class="input-Wrapper">
                Ulica <input type="text" name="txt-street" value="<?php if(isset($userDetails[0])) echo $userDetails[0]['street'] ?>">
            </div>

            <div class="input-Wrapper">
                Nr domu <input type="text" name="txt-flatNumber" value="<?php if(isset($userDetails[0])) echo $userDetails[0]['flatNumber'] ?>">
            </div>

            <div class="input-Wrapper">
                Nr mieszkania <input type="text" name="txt-houseNumber" value="<?php if(isset($userDetails[0])) echo $userDetails[0]['houseNumber'] ?>">
            </div>

            <div class="input-Wrapper">
                Uwago do zamówienia <input type="text" name="txt-additionalInfo">
            </div>

            <input type="submit" name="btn-finalizeOrder" value="Złóż zamówienie">
        </form>
    </div>
    <?php
}