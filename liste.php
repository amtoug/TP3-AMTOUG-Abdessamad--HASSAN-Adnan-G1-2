<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" type="text/css" href="public/style.css" />
</head>
<body>
<?php include "haut.php";?>

<h1>Liste des étudiants</h1>
<hr />

<?php
include 'connexion.php';

$error = isset($_GET['error']) ? $_GET['error'] : '';
$success = isset($_GET['success']) ? $_GET['success'] : '';

try {
    $etudiants = getListeEtudiants(); // Récupérer tous les étudiants

    if (count($etudiants) > 0) {
        echo "<table>";
        echo "<thead><tr><th>Nom</th><th>Prénom</th><th>Filière</th><th>Note</th><th colspan='2'>Actions</th></tr></thead>";
        echo "<tbody>";
        
        foreach ($etudiants as $etudiant) {
            echo "<tr>";
            echo "<td aria-describedby='Nom :'>" . htmlspecialchars($etudiant['Nom']) . "</td>";
            echo "<td aria-describedby='Prénom :'>" . htmlspecialchars($etudiant['Prenom']) . "</td>";
            echo "<td aria-describedby='Filière :'>" . htmlspecialchars($etudiant['Filiere']) . "</td>";
            echo "<td aria-describedby='Note :'>" . htmlspecialchars($etudiant['Note']) . "</td>";
            echo "<td aria-describedby='Modifier :'>";
            echo "<a class='Envoyer' href='modifier_etudiant.php?CodeE=" . htmlspecialchars($etudiant['CodeE']) . "' class='action-link'>Modifier</a>";
            echo "</td>";
            echo "<td aria-describedby='Supprimer :'>";
            echo "<a class='Supp' href='supprimer_etudiant.php?CodeE=" . htmlspecialchars($etudiant['CodeE']) . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet étudiant?\");' class='action-link'>Supprimer</a>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
        
    } else {
        echo "Aucun étudiant trouvé.";
    }
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

<?php if ($error)?>
    <div style="color: red;"><?php echo htmlspecialchars($error); ?></div>
<?php if ($success)?>
    <div style="color: green;"><?php echo htmlspecialchars($success); ?></div>
<?php if (isset($_SESSION['message']))?>
    <div style="color: green;"><?php if(isset($_SESSION['message'])){echo $_SESSION['message']; unset($_SESSION['message']);}?></div>

<br />
<hr />
<a href="accueil.php">Accueil</a> |
<a href="ajouter_etudiant.php">Ajouter un étudiant</a>
<br /><hr /><br />
<div class="bas">&copy; copyright: D3SI 2024<br />Faculté Polydisciplinaire Béni Mellal <br />d3si@usms.ma</div>
</body>
</html>
