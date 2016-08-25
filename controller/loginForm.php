<form action="<?php echo $dir; ?>" method="POST" enctype="multipart/form-data">
    <?php
    if (!isset($_SESSION['userLogin'])) {
        ?>       
        Login <input type="text" name="login"/>
        Hasło <input type="password" name="password"/>

        <input type="submit" name="btn-Login" value="Zaloguj się"/>
        <?php
    } else {
        ?>
        Zalogowany użytkownik: <?php echo $_SESSION['userLogin']; ?>
        <input type="submit" name="btn-Logout" value="Wyloguj się"/>
        <?php
    }
    ?>
</form>