<form action="index.php" method="POST" enctype="multipart/form-data">
    <?php
        if (isset($_SESSION['loggedUserID'])) {
            echo "Zalogowany użytkownik: ".($_SESSION['loggedUserName']!=""?$_SESSION['loggedUserName']:$_SESSION['loggedUserLogin']);
        }
    ?>
    <input type="submit" name="btn-Logout" value="Wyloguj się" />
</form>