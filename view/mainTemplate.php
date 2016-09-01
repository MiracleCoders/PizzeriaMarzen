<?php require './controller/loginForm.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo $dir; ?>/view/styles/style.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

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
                                            Zalogowany użytkownik: <?php echo $_SESSION['userLogin']; ?>
                                            <input type="submit" name="btn-Logout" value="Wyloguj się"/>
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
                            <br/>

                            <div class="tile">
                                <div class="inner">
                                    Kafelek 1
                                </div>
                            </div>

                            <div class="tile">
                                <div class="inner">
                                    Kafelek 1
                                </div>
                            </div>

                            <div class="tile">
                                <div class="inner">
                                    Kafelek 1
                                </div>
                            </div>

                            <div class="tile">
                                <div class="inner">
                                    Kafelek 1
                                </div>
                            </div>

                            <div class="tile">
                                <div class="inner">
                                    Kafelek 1
                                </div>
                            </div>

                        </div
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
