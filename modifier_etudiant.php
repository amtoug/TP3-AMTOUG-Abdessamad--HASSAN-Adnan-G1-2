<?php
include 'connexion.php';
include 'haut.php';

function modifierEtudiant($id, $data) {
    global $conn;

    $sql = "UPDATE Etudiant SET Nom = :Nom, Prenom = :Prenom, Filiere = :Filiere, Note = :Note WHERE CodeE = :CodeE";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':Nom', $data['Nom']);
    $stmt->bindParam(':Prenom', $data['Prenom']);
    $stmt->bindParam(':Filiere', $data['Filiere']);
    $stmt->bindParam(':Note', $data['Note']);
    $stmt->bindParam(':CodeE', $id);

    return $stmt->execute();
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['CodeE'])) {
    $id = $_POST['CodeE'];
    $data = [
        'Nom' => $_POST['Nom'],
        'Prenom' => $_POST['Prenom'],
        'Filiere' => $_POST['Filiere'],
        'Note' => $_POST['Note']
    ];
    if (modifierEtudiant($id, $data)) {
    $success = "Étudiant modifié avec succès.";
    header("Location: liste.php?success=" . urlencode($success));
    exit;
    } 
    else {
        $error = "Erreur lors de la modification de l'étudiant.";
    }
} elseif (isset($_GET['CodeE'])) {
    $id = $_GET['CodeE'];
    $stmt = $conn->prepare("SELECT * FROM Etudiant WHERE CodeE = :CodeE");
    $stmt->bindParam(':CodeE', $id);
    $stmt->execute();

    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$etudiant) {
        $error = "Étudiant non trouvé.";
        header("Location: liste.php?error=" . urlencode($error));
        exit;
    }
} else {
    $error = "ID de l'étudiant non fourni.";
    header("Location: liste.php?error=" . urlencode($error));
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Étudiant</title>
</head>
<body>
    <h1>Modifier Étudiant</h1>

    <?php if ($error): ?>
        <div style="color: red;"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if (isset($etudiant)): ?>
        <form action="modifier_etudiant.php" method="post">
            <input type="hidden" name="CodeE" value="<?php echo htmlspecialchars($etudiant['CodeE']); ?>">

            <label for="Nom">Nom :</label><br>
            <input type="text" id="Nom" name="Nom" value="<?php echo htmlspecialchars($etudiant['Nom']); ?>" required><br><br>

            <label for="Prenom">Prénom :</label><br>
            <input type="text" id="Prenom" name="Prenom" value="<?php echo htmlspecialchars($etudiant['Prenom']); ?>" required><br><br>

            <label for="Filiere">Filière :</label><br>
            <input type="text" id="Filiere" name="Filiere" value="<?php echo htmlspecialchars($etudiant['Filiere']); ?>" required><br><br>

            <label for="Note">Note :</label><br>
            <input type="number" id="Note" name="Note" value="<?php echo htmlspecialchars($etudiant['Note']); ?>" required><br><br>

            <input type="submit" value="Mettre à jour">
        </form>
    <?php 
        endif; 
    ?>
    <?php include 'bas.php'; ?>
</body>
</html>
