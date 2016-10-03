<?php
require './controller/loginForm.php';
require './controller/productMgmt.php';
require './controller/ingredientMgmt.php';
require './controller/productOrder.php';
require './controller/finalizeOrder.php';
require './controller/pendingOrders.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo $dir; ?>/view/styles/style.css">
        <link rel="stylesheet" href="<?php echo $dir; ?>/view/styles/mobile.css">
        <!--<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>-->
        <script src="scripts/jquery-3.1.0.min.js" type="text/javascript"></script>
        <title></title>
    </head>

    <body>
        <div id="mainWrapper">
            <div id="bg">
                <div class="mainHeader">

                    <div class="col-8">
                        <div class="mainLogo">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="userLogin">
                            <?php if (!isset($_SESSION['userLogin'])) { ?>
                                <input type="button" id="btn-signIn" value="Zaloguj/zarejestruj się">
                                <?php
                            } else {
                                ?>

                                <form action="index.php" method="POST" enctype="multipart/form-data">
                                    <?php
                                    if (isset($_SESSION['userLogin'])) {
                                        ?>
                                        Witaj, <?php echo $_SESSION['userLogin']; ?>
                                        <input type="submit" name="btn-Logout" value="Wyloguj się"/>
                                        <input type="submit" name="btn-showCart" value="Koszyk"/>
                                        <?php
                                    }
                                    ?>
                                </form>

                                <?php
                            }
                            $dir = $_SERVER["PHP_SELF"];
                            //var_dump($_SESSION);
//                            require "./controller/loginForm.php";
                            ?>
                        </div>
                    </div>

                </div>

                <div class="mainMenu">
                    <div class="col-12">
                        <ul>
                            <li><a class="active" href="#home">Strona główna</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropbtn" id="btn-showProducts">Menu</a>
                                <div class="dropdown-content">
                                    <a href="#">Pizza</a>
                                    <a href="#">Fast food</a>
                                    <a href="#">Sałatki</a>
                                    <a href="#" id="btn-showCart">Koszyk</a>
                                    <a href="#" id="btn-finalizeOrder">Finalizuj zamówienie</a>
                                </div>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropbtn">Administracja</a>
                                <div class="dropdown-content">
                                    <a href="#" id="btn-productMgmt">Zarządzanie produktami</a>
                                    <a href="#" id="btn-ingredientMgmt">Zarządzanie składnikami</a>
                                    <a href="#">Zarządzanie pracownikami</a>
                                    <a href="#">Zarządzanie promocjami</a>
                                    <a href="#">Opcje strony</a>
                                </div>
                            </li>
                            <li><a href="#" class="active" id="btn-showPendingOrders">Pokaż zamówienia</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mainContent">
                    <div class="col-12">
                        <!--MAIN CONTENT-->
                        <div id="dynamicContent">
                            <br/>


                        </div>
                    </div>
                </div>
            </div>
            <div class="mainFooter">
                <div class="col-12">
                    <!--FOOTER-->
                </div>
            </div>
        </div>
    </body>

    <script src="./scripts/scripts.js" type="text/javascript"></script>
</html>

<?php
//
var_dump ($_SESSION);