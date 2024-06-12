<?php
include 'connexion.php';
include 'haut.php';

function supprimerEtudiant($id) {
    global $conn;

    $sql = "DELETE FROM Etudiant WHERE CodeE = :CodeE";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CodeE', $id);

    return $stmt->execute();
}

$error = "";
$success = "";

if (isset($_GET['CodeE'])) {
    $id = $_GET['CodeE'];

    if (supprimerEtudiant($id)) {
        $success = "Étudiant supprimé avec succès.";
        header("Location: liste.php?success=" . urlencode($success));
        exit;
    } else {
        $error = "Erreur lors de la suppression de l'étudiant.";
    }
} else {
    $error = "ID de l'étudiant non fourni.";
}

header("Location: liste.php?error=" . urlencode($error));
exit;
?>
