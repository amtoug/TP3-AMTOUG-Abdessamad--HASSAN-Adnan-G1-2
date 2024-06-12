<?php
// connexion.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scolarite";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}

function getListeEtudiants($filiere = null) {
    global $conn;
    if ($filiere) {
        $stmt = $conn->prepare("SELECT * FROM Etudiant WHERE Filiere = :Filiere");
        $stmt->bindParam(':Filiere', $filiere);
    } else {
        $stmt = $conn->prepare("SELECT * FROM Etudiant");
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
