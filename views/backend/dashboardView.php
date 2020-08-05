<?php
$title = "Tableau de Bord";
?>

<?php ob_start(); ?>

<h1>Tableau de Bord</h1>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>