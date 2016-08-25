<?php
// Obsługa przycisku logowania
if (isset($_POST['btn-Login'])) {
    // Tworzymy zmienną z obiektem typu danych użytkownika (klasa user)
    // Zbieramy z pól filtrowane dane
    $user = new userData();
    $user->login = filter_input(INPUT_POST, 'login');
    $user->password = filter_input(INPUT_POST, 'password');
    // Tworzymy zmienną obiektową dla zalogowanego użytkownika
    if ($user->login != "") {
        // Jest login
        if ($user->password != "") {
            // Jest login i jest hasło
            $loggedUser = new userService($user);
            $errType = $loggedUser->userLoginCheck();
            //msgBox("Login: " . $user->login . "\\n" . $allErrors[$errType]); // wyświetl wprowadzone dane
            if ($errType != 0) {
                // Błąd logowania
                echo "<br />" . $allErrors[$errType] . ' (Error: ' . $errType . ')';
            } else {
                // Logowanie zakończone sukcesem
                $_SESSION['userId'] = $user->id;
                $_SESSION['userLogin'] = $user->login;
            //    header("Location: " . basename(__FILE__));
            }
        } else {
            $errType = 202; // Jest login, nie ma hasła
        }
    } else {
        $errType = 202; // Nie ma loginu (i hasła)
    }
}

if (isset($_POST['btn-Logout'])) {
    if (isset($_SESSION['userLogin']) && $_SESSION['userLogin'] != "") {
        $loggedUser->logout();
      //  header("Location: " . basename(__FILE__));
    } else {
        $errType = 210; // Nie można wylogować
    }
}
?>