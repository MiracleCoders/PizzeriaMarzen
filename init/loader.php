<?php

define('DIR_BASE',  dirname(dirname(__FILE__)));

$GLOBALS['dir'] = '//' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
$GLOBALS['root'] = $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen";
echo "Dir: " . $dir . "<br />Root: " . $root . "<br />";

require_once "./init/dbConnect.php";
require_once "./include/userData.php";
require_once "./include/userService.php";

// Funkcja wyświetlająca alert z tekstem

function msgBox($txt) {
    echo sprintf("<script type=\"text/javascript\">alert(\"%s\");</script>", $txt);
}

function msgBox2($txt) {
    echo sprintf("<script type=\"text/javascript\">debug=\"%s\";</script>", $txt);
}

// Jeżeli użytkownik jest zalogowany to trzeba stworzyć obiekt user i loggedUser
// bo przy każdym odświeżeniu strony znika

$user = new userData();

if (isset($_POST['btn-mainPage'])) {
    unset($_POST['btn-showProducts']);
    unset($_POST['btn-productMgmt']);
    unset($_SESSION['showProducts']);
    unset($_SESSION['productMgmt']);
}

if (isset($_SESSION['loggedUserID']) && $_SESSION['loggedUserID'] != "") {
    $user->id = $_SESSION['loggedUserID'];
    $user->login = $_SESSION['loggedUserLogin'];
    $user->name = $_SESSION['loggedUserName'];
    $user->lastName = $_SESSION['loggedUserLastName'];
    $user->privileges = $_SESSION['loggedUserPrivileges'];
    require_once "./controller/showProducts.php";
    require_once "./controller/productMgmt.php";
} else {
    require_once "./controller/loginForm.php";
    $_SESSION['loginForm'] = true;
}

$loggedUser = new userService($user);

if (isset($_POST['btn-Logout'])) {
    require_once "./controller/logout.php";
}

if (!isset($_SESSION['template'])) {
    $_SESSION['template'] = "default";
}

$template = $_SESSION['template'];
$templateHeader = "./view/templates/" . $template . "/header.php";
if (!file_exists($templateHeader)) {
    $templateHeader = "./view/templates/default/header.php";
}
$templateMenu = "./view/templates/" . $template . "/menu.php";
if (!file_exists($templateMenu)) {
    $templateMenu = "./view/templates/default/menu.php";
}
$templateMain = "./view/templates/" . $template . "/main.php";
if (!file_exists($templateMain)) {
    $templateMain = "./view/templates/default/main.php";
}
$templateShowProducts = "./view/templates/" . $template . "/showProducts.php";
if (!file_exists($templateShowProducts)) {
    $templateShowProducts = "./view/templates/default/showProducts.php";
}
$templateProductMgmt = "./view/templates/" . $template . "/productMgmt.php";
if (!file_exists($templateProductMgmt)) {
    $templateProductMgmt = "./view/templates/default/productMgmt.php";
}
$templateFooter = "./view/templates/" . $template . "/footer.php";
if (!file_exists($templateFooter)) {
    $templateFooter = "./view/templates/default/footer.php";
}
$templateLoginForm = "./view/templates/" . $template . "/loginForm.php";
if (!file_exists($templateLoginForm)) {
    $templateLoginForm = "./view/templates/default/loginForm.php";
}
$templateLoginFormJS = "./view/templates/" . $template . "/loginFormJS.php";
if (!file_exists($templateLoginFormJS)) {
    $templateLoginFormJS = "./view/templates/default/loginFormJS.php";
}
$templateUserPanel = "./view/templates/" . $template . "/userPanel.php";
if (!file_exists($templateUserPanel)) {
    $templateUserPanel = "./view/templates/default/userPanel.php";
}

if (isset($_SESSION['mainPage']) && $_SESSION['mainPage'] == true) {
    
}

if (isset($_SESSION['registerForm'])) {
    include_once "./controller/registerForm.php";
    $_SESSION['registerForm'] = true;
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./view/styles/style.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="./scripts/scripts.js" type="text/javascript"></script>
        <title></title>
    </head>
    <body>
        <div id="mainWrapper">
            <div id="bg">
                <div class="mainHeader">
                    <?php include $templateHeader; ?>
                </div>
                <div class="mainMenu">
                    <?php include $templateMenu; ?>
                </div>
                <div class="mainContent">
                    <?php include $templateMain; ?>
                </div>
            </div>
            <div class="mainFooter">
                <?php include $templateFooter; ?>
            </div>
        </div>

        <script type="text/javascript">
            btnMainPage = $("input[name*='btn-mainPage']");
            btnMainPage.on("click", function () {
                closeDynamicContent();
                return false;
            });
<?php
if (isset($_SESSION['loggedUserID']) && $_SESSION['loggedUserID'] != "") {
    ?>
                btnShowProducts = $("input[name*='btn-showProducts']");
                btnShowProducts.on("click", function () {
                    removeDOMElement("#showProducts");
                    if (!$("#showProducts")[0]) {
                        createDOMElement(".mainContent", "showProducts", "<?php echo $templateShowProducts; ?>");
                        return false;
                    }
                });
                btnProductMgmt = $("input[name*='btn-productMgmt']");
                btnProductMgmt.on("click", function () {
                    removeDOMElement("#form-productMgmt");
                    if (!$("#form-productMgmt")[0]) {
                        createDOMElement(".mainContent", "form-productMgmt", "<?php echo $templateProductMgmt; ?>");
                        return false;
                    }
                });
    <?php
} else {
?>
                btnShowProducts = $("input[name*='btn-showProducts']");
                btnShowProducts.on("click", function () {
                    return false;
                });
                btnProductMgmt = $("input[name*='btn-productMgmt']");
                btnProductMgmt.on("click", function () {
                    return false;
                });
<?php
}
?>
        </script>
    </body>
</html>