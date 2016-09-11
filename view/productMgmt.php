<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/PizzeriaMarzen/include/ProductMgmt.php";
$ingredients = new ProductMgmt(0, 0, 0);
$allIngredients = $ingredients->fetchIngredients();
?>
<div class="title">
    Zarządzenie produktami
</div>
<div class="form-productMgmt">
    <div class="inner">
        <form action="index.php" method="POST" enctype="multipart/form-data">
            Nazwa <input type="text" name="productName"/>            
            Cena <input type="text" name="productPrice"/>
            Opis <input type="text" name="productDescription"/>
                <?php foreach ($allIngredients as $ingredient) { ?>
                <input type="checkbox" name="check_ingredients[]" value="<?php echo $ingredient['id_ingredient']; ?>">
                        <?php echo $ingredient['name']; ?>
                <?php } ?>
            <input type="submit" name="btn-addProduct" value="Dodaj produkt"/>
        </form>
    </div>
</div>