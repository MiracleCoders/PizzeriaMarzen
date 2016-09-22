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

