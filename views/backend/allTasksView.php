<?php
$title = "Toutes les tâches";
?>

<?php ob_start(); ?>

<h1>Toutes les tâches</h1>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>