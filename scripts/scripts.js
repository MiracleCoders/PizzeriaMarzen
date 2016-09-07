//dynamicContent
function closeDynamicContent() {
    dynamicContent = document.getElementById("dynamicContent");
    if (dynamicContent) dynamicContent.parentNode.removeChild(dynamicContent);
}

//Rejestracja
$("#btn-signIn").on("click", function () {
    if (!document.getElementById("registerForm")) {
        regDiv = document.createElement("div");
        regDiv.setAttribute("id", "registerForm");
        document.getElementsByClassName("mainContent")[0].appendChild(regDiv);
        $("#registerForm").load("./view/loginForm.php");
    }
});

function closeRegisterForm() {
    registerFormByID = document.getElementById("registerForm");
    if (registerFormByID) registerFormByID.parentNode.removeChild(registerFormByID);
}

//Produkty
$("#btn-showProducts").on("click", function () {
    closeDynamicContent();
    if (!document.getElementById("showProducts")) {
        regDiv = document.createElement("div");
        regDiv.setAttribute("id", "showProducts");
        document.getElementsByClassName("mainContent")[0].appendChild(regDiv);
        $("#showProducts").load("./view/showProducts.php");
    }
});

//Zarządzanie produktami
$("#btn-productMgmt").on("click", function () {
    closeDynamicContent();
    if (!document.getElementById("form-productMgmt")) {
        regDiv = document.createElement("div");
        regDiv.setAttribute("id", "form-productMgmt");
        document.getElementsByClassName("mainContent")[0].appendChild(regDiv);
        $("#form-productMgmt").load("./view/productMgmt.php");
    }
});

