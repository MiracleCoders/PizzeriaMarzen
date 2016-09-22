<div class="col-12">
    <!--MAIN CONTENT-->
    <div id="dynamicContent">
        <br/>

        <?php
            if (isset($_SESSION['showProducts']) && $_SESSION['showProducts'] == true) {
                include $templateShowProducts;
            }

            if (isset($_SESSION['productMgmt']) && $_SESSION['productMgmt'] == true) {
                include $templateProductMgmt;
            }
        ?>
        
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
    </div>
</div>