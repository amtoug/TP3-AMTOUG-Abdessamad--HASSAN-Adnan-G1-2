<?php
session_start();
function afficherDate($lang = "FR")
{
    $jours["AR"] = array("الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت");
    $jours["FR"] = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
    $jours["EN"] = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

    $months["AR"] = ["يناير ", "فبراير", "مارس ", "أبريل", "ماي ", "يونيو", "يوليوز", "غشت ", "شتنبر", "أكتوبر", "نونبر", "دجنبر"];
    $months["EN"] = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    $months["FR"] = ["Janvier", "Février", "Mars", "Avril", "Mai", "juin", "Juillet", "Aôut", "Septembre", "Octobre", "Novembre", "Décembre"];

    $d = getdate(); // Obtient les informations de date du serveur.

    $jourSem = $d["wday"];
    $jourMois = $d["mday"];
    $mois = $d["mon"];
    $annee = $d["year"];

    $d = $jours[$lang][$jourSem] . " " . $jourMois . " " . $months[$lang][$mois - 1] . " " . $annee;
    return $d;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="public/style.css"/>
    <script type="text/javascript" src="public/script.js"></script>
    <!-- Utilisez les cookies pour personnaliser le style et la langue -->
    <style>
        body {
        <?php if(isset($_COOKIE['background_color'])): ?>
            background-color: <?php echo $_COOKIE['background_color']; ?>;
        <?php endif; ?>
        }
    </style>
</head>
<body>
<div class="top">
    <img src='public/images/fpbm.jpg' class="small-image image-margin"/>
    <span class="large-text">D3SI</span><br/>
    <span class="small-text">Facult&eacute; Polydisciplinaire B&eacute;ni Mellal</span>
</div>
<h4> <?php if (isset($_COOKIE['language'])) {
        echo afficherDate($_COOKIE['language']);
    }else {
        echo afficherDate();
    }
     ?> </h4>
<div align= "right">
    <?php if (isset($_SESSION["login"])){?>
        Vous êtes connectés en tant que:  <?= $_SESSION["login"] ?> &nbsp;&nbsp;&nbsp;&nbsp;
        <a href = "deconnexion.php">Déconnexion</a>
    <?php } else {?>Non Connecté<?php }?>&nbsp;&nbsp; || &nbsp;&nbsp; <a href = "options.php">Options</a>  &nbsp;&nbsp;

</div>
<br />