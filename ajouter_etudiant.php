<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="public/script.js"></script>
    <title>Ajouter un étudiant</title>
    <link rel="stylesheet" type="text/css" href="public/style.css" />
</head>
<body>
<?php include "haut.php";?>


<h1>Ajouter un étudiant</h1>
<hr />

<!-- Traitement du formulaire -->
<?php

include 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nom = filter_input(INPUT_POST, 'Nom', FILTER_SANITIZE_STRING);
    $prenom = filter_input(INPUT_POST, 'Prenom', FILTER_SANITIZE_STRING);
    $filiere = filter_input(INPUT_POST, 'Filiere', FILTER_SANITIZE_STRING);
    $note = filter_input(INPUT_POST, 'Note', FILTER_VALIDATE_FLOAT);
    $Errors=[];
    if(trim($nom)==''){
        $Errors['nom'] = "Le nom est obligatoire.";
    }
    if(trim($prenom)=="") {
        $Errors['prenom'] = "Le prénom est obligatoire.";
    }
    if(trim($note)=="" || $note < 0 || $note > 20){
        $Errors['note'] = "La note doit être un nombre entre 0 et 20.";
    }

    if(!empty($Errors)){
        $_SESSION['Errors']=$Errors;
        header("Location: ajouter_etudiant.php");
        exit;
    }
    if ($nom && $prenom && $filiere && $note !== false) {
        try {
            $stmt = $conn->prepare("INSERT INTO Etudiant (Nom, Prenom, Filiere, Note) VALUES (:nom, :prenom, :filiere, :note)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':filiere', $filiere);
            $stmt->bindParam(':note', $note);
            $stmt->execute();
            $_SESSION['message'] = "Étudiant ajouté avec succès.";
            header("Location: liste.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['message'] = "Erreur lors de l'ajout de l'étudiant: " . $e->getMessage();
        }
    } else {
        $_SESSION['message'] = "Tous les champs sont obligatoires et doivent être valides.";
    }
}
?>

<?php
if (isset($_SESSION['message'])) {
    echo '<div class="message Err">' . htmlspecialchars($_SESSION['message']) . '</div>';
    unset($_SESSION['message']);
}
?>

<!-- Formulaire d'ajout d'étudiant -->
<form id="myForm" name="myForm" action="ajouter_etudiant.php" method="post" onsubmit="return validateForm()">
<pre>
<label for="Nom">Entrez le nom:</label>
<input type="text" id="Nom" name="Nom" required /><?php if(isset($_SESSION["Errors"]["nom"])) echo "<span class='Err' id='ErrNom'>{$_SESSION["Errors"]['nom']}</span>";?><br />

<label for="Prenom">Entrez le prénom:</label>
<input type="text" id="Prenom" name="Prenom" required /> <?php if(isset($_SESSION["Errors"]["prenom"])) echo "<span class='Err' id='ErrPrenom'>{$_SESSION["Errors"]['prenom']}</span>";?><br />

<label for="Note">Entrez la note:</label>
<input type="text" id="Note" name="Note" required /> <?php if(isset($_SESSION["Errors"]["note"])) echo "<span class='Err' id='ErrNote'>{$_SESSION["Errors"]['note']}</span>";?><br />

<label for="Filiere">Filière:</label>
<select id="Filiere" name="Filiere">
    <option value="D3SI" selected>Data Science et Sécurité des Systèmes d’Information</option>
    <option value="SMI">Sciences Mathématiques et Informatique</option>        
    <option value="SMA">Sciences Mathématiques et Application</option>
    <option value="SMP">Sciences de la Matière Physique</option>
</select> <span class="Err"></span><br />

<input type="hidden"  name="csrf_token" value="<?php echo isset($_SESSION['csrf_token']) ? htmlspecialchars($_SESSION['csrf_token']) : ''; ?>" />
<input type='submit' value="Envoyer" class="Envoyer"/> <input type='reset' value='Annuler' class="Annuler"/>
</pre>
</form>
<?php
if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
?>
<br />
<hr />
<a href="accueil.php">Accueil</a> | 
<a href="liste.php">Liste des étudiants</a> |
<a href="ajouter_etudiant.php">Ajouter un étudiant</a>
<br /><hr /><br />
<div class="bas">&copy; copyright: D3SI 2024<br />Faculté Polydisciplinaire Béni Mellal <br />d3si@usms.ma</div>

<script>
// function validateForm() {
//     let valid = true;
//     const nom = document.getElementById('Nom').value;
//     const prenom = document.getElementById('Prenom').value;
//     const note = document.getElementById('Note').value;
//     const errNom = document.getElementById('ErrNom');
//     const errPrenom = document.getElementById('ErrPrenom');
//     const errNote = document.getElementById('ErrNote');

//     errNom.textContent = '';
//     errPrenom.textContent = '';
//     errNote.textContent = '';

//     if (nom.trim() === '') {
//         errNom.textContent = 'Le nom est obligatoire.';
//         valid = false;
//     }

//     if (prenom.trim() === '') {
//         errPrenom.textContent = 'Le prénom est obligatoire.';
//         valid = false;
//     }

//     if (note.trim() === '' || isNaN(note) || note < 0 || note > 20) {
//         errNote.textContent = 'La note doit être un nombre entre 0 et 20.';
//         valid = false;
//     }

//     return valid;
// }
</script>
</body>
</html>
