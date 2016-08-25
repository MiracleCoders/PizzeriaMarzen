<?php require 'loginForm.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo $dir; ?>/view/styles/style.css">
        <title></title>
    </head>

    <body>
        <div id="mainWrapper">
            <div id="bg">
                <div class="mainHeader">

                    <div class="col-12">
                        <div class="mainLogo">

                        </div>

                        <div class="userLogin">
                            <?php $dir = $_SERVER["PHP_SELF"]; ?>
                            <?php require "./controller/loginForm.php"; ?>
                        </div>
                    </div>

                </div>

                <div class="mainMenu">
                    <div class="col-12">
                        <ul>
                            <li><a class="active" href="#home">Strona główna</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropbtn">Menu</a>
                                <div class="dropdown-content">
                                    <a href="#">Pizza</a>
                                    <a href="#">Fast food</a>
                                    <a href="#">Sałatki</a>
                                </div>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropbtn">Administracja</a>
                                <div class="dropdown-content">
                                    <a href="#">Zarządzanie produktami</a>
                                    <a href="#">Zarządzanie pracownikami</a>
                                    <a href="#">Zarządzanie promocjami</a>
                                    <a href="#">Opcje strony</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mainContent">
                    <div class="col-12">
                        MAIN CONTENT
                    </div
                </div>

                <div class="mainFooter">
                    <div class="col-12">
                        FOOTER
                    </div>
                </div>

            </div>
        </div>
    </body>

</html>


<?php
