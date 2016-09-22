<form action="index.php" method="POST" enctype="multipart/form-data">
    <noscript>
    Login: <input type="text" name="login" />
    Hasło: <input type="password" name="password" />
    </noscript>
    <input type="submit" name="btn-Login" id="btn-signIn" value="Zaloguj/zarejestruj się" />
    <script type="text/javascript">
        //<!--
        $("#btn-signIn")[0].setAttribute("type","button");
        $("#btn-signIn").on("click", function () {
            removeDOMElement("#registerForm");
            if (!$("#registerForm")[0])
                createDOMElement(".mainContent", "registerForm", "<?php echo $templateLoginFormJS; ?>");
        });
        //-->
    </script>
</form>