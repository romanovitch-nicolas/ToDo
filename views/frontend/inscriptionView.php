<?php
$title = "Inscription";
?>

<?php ob_start(); ?>

<h1>Inscription</h1>

<section id="inscription">
	<?php if (isset($return) && $return !== true) { echo '<p><i class="fas fa-exclamation-circle"></i> ' . $return . '</p>'; } ?>
	<?php if (isset($return) && $return === true) { echo '<p><i class="fas fa-check"></i> Votre inscription est terminé, vous pouvez maintenant <a href="' . LINK_CONNEXION . '">vous connecter</a>.</p>'; } ?>
	<form <?php if (isset($return) && $return === true) { echo 'class="invisible"'; }?> method="POST" action="index.php?action=register">
		<table>
			<tr>
				<td>Identifiant</td>
				<td><input type="text" name="login" maxlength="255" <?php if (isset($_POST['login'])) { echo 'value="' . $_POST['login'] . '"'; } ?> required /></td>
			</tr>
			<tr>
				<td>Mot de passe</td>
				<td><input type="password" name="pass" maxlength="255" required /></td>
			</tr>
			<tr>
				<td>Confirmation</td>
				<td><input type="password" name="pass_confirm" maxlength="255" required /></td>
			</tr>
			<tr>
				<td>Adresse mail</td>
				<td><input type="email" name="mail" maxlength="255" <?php if (isset($_POST['mail'])) { echo 'value="' . $_POST['mail'] . '"'; } ?> required /></td>
			</tr>
		</table>
		<p><input type="submit" name="Inscription" value="S'inscrire" /></p>
	</form>
	<p>Déjà inscrit ?</p>
	<p>Mot de passe oublié ?</p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('frontendTemplate.php'); ?>