$("#btn-signIn").on("click", function () {
    if (!document.getElementById("registerForm")) {
        regDiv = document.createElement("div");
        regDiv.setAttribute("id", "registerForm");
        document.getElementsByClassName("mainContent")[0].appendChild(regDiv);
        $("#registerForm").load("./view/loginForm.php");
    }
});