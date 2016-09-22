<div class="form-register">
    <div class="inner">
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <?php
            if (!isset($_SESSION['loggedUserID'])) {
                ?>       
                Login <input type="text" name="login"/>
                Hasło <input type="password" name="password"/>

                <input type="submit" name="btn-Login" value="Zaloguj się"/>
                <?php if (isset($_SESSION['lastLoggedUserID'])) {
                    ?> <input type="submit" name="btn-Relogin" value="Zaloguj ponownie"/>
                <?php
                }
                ?>
                <input type="submit" name="btn-Register" value="Zarejestruj się"/>
                <?php
            } else {
                ?>
                Zalogowany użytkownik: <?php echo $_SESSION['loggedUserName']; ?>
                <input type="submit" name="btn-Logout" value="Wyloguj się"/>
                <?php
            }
            ?>
        </form>
        <input type="button" onclick="removeDOMElement('#registerForm')" value="Zamknij" />
    </div>
</div>