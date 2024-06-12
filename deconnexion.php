<?php
session_start(); // Démarre la session si ce n'est pas déjà fait

// Détruit toutes les données de la session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également le cookie de session.
// Notez que cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Enfin, on détruit la session
session_destroy();

// Redirige vers la page de connexion
header("Location: login.php");
exit;
?>
