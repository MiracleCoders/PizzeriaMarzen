<div class="col-8">
    <div class="mainLogo">
    </div>
</div>

<div class="col-3">
    <div class="userLogin">
        <?php
            if (isset($_SESSION['lastLoggedUserID'])) {
                ?>
            <?php
            }
            if (!isset($_SESSION['loggedUserID'])) {
                include $templateLoginForm;
            } else {
                include $templateUserPanel;
            }
        ?>
    </div>
</div>