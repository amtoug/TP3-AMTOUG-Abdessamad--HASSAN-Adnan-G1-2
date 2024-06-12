<?php
include "haut.php";

// Vérifie si le formulaire est soumis
if(isset($_POST['submit'])) {
    // Récupère les valeurs saisies par l'utilisateur
    $background_color = $_POST['background_color'];
    $language = $_POST['language'];

    // Crée des cookies pour stocker les préférences de l'utilisateur pendant 10 jours
    setcookie('background_color', $background_color, time() + (10 * 24 * 60 * 60)); // 10 jours en secondes
    setcookie('language', $language, time() + (10 * 24 * 60 * 60)); // 10 jours en secondes

    // Redirige vers la page d'accueil ou une autre page
    header("Location: accueil.php");
    exit;
}
?>



<!-- Formulaire pour les options -->
<form action="" method="post">
    <label for="background_color">Couleur de l'arrière-plan :</label>
    <input type="color" id="background_color" name="background_color" required><br>

    <label for="language">Langue préférée :</label>
    <select id="language" name="language" required>
        <option value="FR">Français</option>
        <option value="EN">English</option>
        <option value="AR">العربية</option>
    </select><br>

    <input type="submit" name="submit" value="Enregistrer">
</form>
<?php include "bas.php"; ?>

