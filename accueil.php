<?php
include "haut.php";

// Vérifie si l'utilisateur est connecté, sinon le redirige vers la page de connexion
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


// $filieres[]= ["CodeF"=>"D3SI","IntituleF"=>"Data Science et Sécurité des Systèmes d'Information"];
// $filieres[]= array("CodeF"=>"SMI","IntituleF"=>"Sciences Mathématiques et Informatique");
// $filieres[]= ["CodeF"=>"SMA","IntituleF"=>"Sciences Mathématiques et Application"];
// $filieres[]= ["CodeF"=>"SMP","IntituleF"=>"Sciences de la Matière Physique"];

include 'connexion.php';

function getListeFilieres($conn) {
    try {
        $stmt = $conn->query("SELECT * FROM Filiere");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

$filieres = getListeFilieres($conn);
?>
 
<h1 aligne="center">Affichage des résultats</h1>

<hr />
<b>Cliquez sur une filière pour voir les résultats </b><br />

<ol>
	<?php 
		foreach ($filieres as $filiere) { ?>
			<li>
				<a href ="liste.php?filiere=<?= $filiere["CodeF"]?>"><?= $filiere["IntituleF"]?> </a>
			</li>
		<?php } ?>

</ol>

<?php include "bas.php"; ?>
