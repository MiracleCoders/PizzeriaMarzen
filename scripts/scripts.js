function createDOMElement(select,insertedID,addr) {
    element = document.createElement("div");
    element.setAttribute("id",insertedID);
    $(select).append(element);
    if (addr) $("#"+insertedID).load(addr);
}

function removeDOMElement(select) {
    $(select).detach();
}
//dynamicContent
function closeDynamicContent() {
    dynamicContent = document.getElementById("dynamicContent");
    if (dynamicContent) dynamicContent.parentNode.removeChild(dynamicContent);
}

//Rejestracja
$("#btn-signIn").on("click", function () {
    if (!$("#registerForm")[0]) createDOMElement(".mainContent","registerForm","./view/loginForm.php");
});

function closeRegisterForm() {
    removeDOMElement("#registerForm");
}

//Produkty
$("#btn-showProducts").on("click", function () {
    removeDOMElement("#showProducts");
    if (!$("#showProducts")[0]) createDOMElement(".mainContent>.col-12","showProducts","./view/showProducts.php");
});

//Zarządzanie produktami
$("#btn-productMgmt").on("click", function () {
    removeDOMElement("#form-productMgmt");
    if (!$("#form-productMgmt")[0]) createDOMElement(".mainContent>.col-12","form-productMgmt","./view/productMgmt.php");
});

//Zarządzanie składnikami
$("#btn-ingredientMgmt").on("click", function () {
    removeDOMElement("#form-ingredientMgmt");
    if (!$("#form-ingredientMgmt")[0]) createDOMElement(".mainContent>.col-12","form-ingredientMgmt","./view/ingredientMgmt.php");
});

