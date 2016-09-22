<div class="col-12">
    <ul>
        <form action="index.php" method="POST" enctype="multipart/form-data">

            <li class="dropdown">
                <input type="submit" class="dropbtn" name="btn-mainPage" style="background: none; border: none" value="Strona główna" />
            </li>

            <li class="dropdown">
                <input type="submit" class="dropbtn" name="btn-showProducts" id="btn-showProducts" style="background: none; border: none" value="Menu" />
                <div class="dropdown-content">
                    <a href="#">Pizza</a>
                    <a href="#">Fast food</a>
                    <a href="#">Sałatki</a>
                </div>
            </li>

            <li class="dropdown">
                <a href="#" class="dropbtn">Administracja</a>
                <div class="dropdown-content">
                    <a href="#"><input type="submit" id="btn-productMgmt" name="btn-productMgmt" style="background: none; border: none" value="Zarządzanie produktami" /></a>
                    <a href="#">Zarządzanie pracownikami</a>
                    <a href="#">Zarządzanie promocjami</a>
                    <a href="#">Opcje strony</a>
                </div>
            </li>
        </form>
    </ul>
</div>