<?php
$title = "Accueil";
?>

<?php ob_start(); ?>

<section id="home">
	<h1>Organisez votre quotidien avec Tood</h1>
	<div class="center">
		<?php if (isset($_SESSION['id']) OR isset($_COOKIE['id'])) { ?><a class="button" href="<?= LINK_DASHBOARD ?>">Tableau de Bord</a>
		<?php } else { ?><a class="button" href="<?= LINK_INSCRIPTION ?>">S'inscrire</a>
		<?php } ?>
	</div>
	<a class="chevron" href="<?= LINK_FEATURES ?>"><i class="fas fa-chevron-down fa-2x"></i></a>
</section>

<section id="features">
	<div id="features_anchor"></div>
	<div class="column"></div>
	<div class="blank">
		<h2>Fonctionnalités</h2>
		<p>Tood vous permet de créer des tâches rapidement, simplement, et des les organiser en liste.<br /> Selon vos besoin, planifiez-les, de manière récurrente ou non, et déterminez leur degré d'importance.</p>
		<p>C'est 100% gratuit, et sans aucune publicité.</p>
		<div class="center"><img src="public/images/frontend/features.png" /></div>
	</div>
</section>

<section id="contact">
	<div id="contact_anchor"></div>
	<div class="blank">
		<h2>Contact</h2>
		<p>Un problème ? Une suggestion ?<br />Utilisez-le formulaire de contact ci-dessous pour laisser votre message.</p>
		<?php if (isset($return) && $return === true) { echo("<p class='center return'><i class='fas fa-check green'></i> Votre message à bien été envoyé.</p>"); } ?>
		<?php if (isset($return) && $return !== true) { echo("<p class='center return'><i class='fas fa-exclamation-circle red'></i> " . $return . "</p>"); } ?>
		<form method="POST" action="index.php?action=contact#contact_anchor">
		<table>
			<tr>
				<td><label for="messageAuthor">Nom, Prénom</label></td>
				<td><input type="text" id="messageAuthor" name="author" maxlength="255" value ="<?php if (isset($_POST['author']) && isset($return) && $return !== true) { echo $_POST['author']; } ?>" required /></td>
			</tr>
			<tr>
				<td><label for="messageMail">Email</label></td>
				<td><input type="email" id="messageMail" name="mail" maxlength="255" value ="<?php if (isset($_POST['mail']) && isset($return) && $return !== true) { echo $_POST['mail']; } ?>" required /></td>
			</tr>
			<tr>
				<td><label for="messageSubject">Objet</label></td>
				<td><input type="text" id="messageSubject" name="subject" maxlength="255" value ="<?php if (isset($_POST['subject']) && isset($return) && $return !== true) { echo $_POST['subject']; } ?>" required /></td>
			</tr>
			<tr>
				<td><label for="messageContent">Message</label></td>
				<td><textarea id="messageContent" name="content" required><?php if (isset($_POST['content']) && isset($return) && $return !== true) { echo $_POST['content']; } ?></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><p class="center"><input class="button" type="submit" name="sendMessage" value="Envoyer" /></p></td>
			</tr>
		</table>
	</form>
	</div>
	<div class="column"></div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('frontendTemplate.php'); ?>