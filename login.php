<?php
include "haut.php";

// Vérifie si l'utilisateur est déjà authentifié, si oui, redirige vers la page d'accueil
if(isset($_SESSION['login'])) {
    header("Location: accueil.php");
    exit;
}

// Vérifie si le formulaire est soumis
if(isset($_POST['login']) && isset($_POST['pass'])) {
    // Vérifie les identifiants
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    if($login === "admin" && $pass === "admin123") {
        $_SESSION['login'] = $login; // Stocke le login dans la session
        // Redirige vers la page d'accueil après l'authentification
        header("Location: accueil.php");
        exit;
    } else {
        // Stocke le message d'erreur dans la session
        $_SESSION['error'] = "Identifiants incorrects. Veuillez réessayer.";
    }
}


?>
<h1>Authentification</h1>
<?php
// Affichage de l'erreur si elle est présente dans la session
if(isset($_SESSION['error'])) {
    echo "<h4 style='color:red;'>" . $_SESSION['error'] . "</h4>";
    // Supprime l'erreur de la session pour éviter qu'elle ne s'affiche à nouveau
    // après actualisation de la page
    unset($_SESSION['error']);
}
?>
<form name="loginForm" action="" method="post">
    <pre>
    Login    <input name="login" type="text" /> (indication= admin)

    Password <input name="pass" type="password" /> (indication= admin123)

             <input type="submit" value="Envoyer" /> <input type="reset" value="Annuler" />
    </pre>
</form>

<?php include "bas.php"; ?>
