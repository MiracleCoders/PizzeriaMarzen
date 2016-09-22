debug = 0;
/*debugTimer = setInterval(function () {
    if (debug != 0) {
        alert(debug);
        debug = 0;
    }
}, 100);*/

function createDOMElement(select, insertedID, addr) {
    element = document.createElement("div");
    element.setAttribute("id", insertedID);
    $(select).append(element);
    if (addr)
        $("#" + insertedID).load(addr);
}

function removeDOMElement(select) {
    if ($(select)[0])
        $(select).remove();
}

//dynamicContent
function closeDynamicContent() {
    removeDOMElement("#productsList");
    removeDOMElement("#form-productMgmt");
}

//Produkty
$("#btn-showProducts").on("click", function () {
    removeDOMElement("#showProducts");
    if (!$("#showProducts")[0])
        createDOMElement(".mainContent", "showProducts", "./view/showProducts.php");
});

//Zarządzanie produktami
$("#btn-productMgmt").on("click", function () {
    removeDOMElement("#form-productMgmt");
    if (!$("#form-productMgmt")[0])
        createDOMElement(".mainContent", "form-productMgmt", "./view/productMgmt.php");
});

//Zarządzanie składnikami
$("#btn-ingredientMgmt").on("click", function () {
    removeDOMElement("#form-ingredientMgmt");
    if (!$("#form-ingredientMgmt")[0]) createDOMElement(".mainContent>.col-12","form-ingredientMgmt","./view/ingredientMgmt.php");
});

//Pokaż koszyk
$("#btn-showCart").on("click", function () {
    removeDOMElement("#form-showCart");
    if (!$("#form-showCart")[0]) createDOMElement(".mainContent>.col-12","form-showCart","./view/productOrder.php");
});

//Pokaż zamówienie
$("#btn-finalizeOrder").on("click", function () {
    removeDOMElement("#form-finalizeOrder");
    if (!$("#form-finalizeOrder")[0]) createDOMElement(".mainContent>.col-12","form-finalizeOrder","./view/finalizeOrder.php");
});

//Pokaż zamówienie
$("#btn-showPendingOrders").on("click", function () {
    removeDOMElement("#form-finalizeOrder");
    if (!$("#form-pendingOrders")[0]) createDOMElement(".mainContent>.col-12","form-pendingOrders","./view/showPendingOrders.php");
});
