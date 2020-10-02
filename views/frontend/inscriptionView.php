<?php
$title = "Inscription";
?>

<?php ob_start(); ?>

<section id="inscription">
	<div class="column"></div>
	<div class="blank">
		<h1>Inscription</h1>
		<?php if (isset($return) && $return !== true) { echo '<p class="return"><i class="fas fa-exclamation-circle red"></i> ' . $return . '</p>'; } ?>
		<?php if (isset($return) && $return === true) { echo '<p class="return"><i class="fas fa-check green"></i> Votre inscription est terminé, vous pouvez maintenant <a href="' . LINK_CONNECTION . '">vous connecter</a>.</p>'; } ?>
		<form <?php if (isset($return) && $return === true) { echo 'class="invisible"'; }?> method="POST" action="verification-inscription">
			<table>
				<tr>
					<td><label for="login">Identifiant</label></td>
					<td><input type="text" name="login" maxlength="255" <?php if (isset($_POST['login'])) { echo 'value="' . $_POST['login'] . '"'; } ?> required /></td>
				</tr>
				<tr>
					<td><label for="pass">Mot de passe</label></td>
					<td><input type="password" name="pass" maxlength="255" required /></td>
				</tr>
				<tr>
					<td><label for="pass_confirm">Confirmation</label></td>
					<td><input type="password" name="pass_confirm" maxlength="255" required /></td>
				</tr>
				<tr>
					<td><label for="mail">Adresse mail</label></td>
					<td><input type="email" name="mail" maxlength="255" <?php if (isset($_POST['mail'])) { echo 'value="' . $_POST['mail'] . '"'; } ?> required /></td>
				</tr>
			</table>
			<p class="center"><input class="button" type="submit" name="Inscription" value="S'inscrire" /></p>
			<p class="center"><a href="<?= LINK_CONNECTION ?>">Déjà inscrit ?</a></p>
			<p class="center"><a href="mot-de-passe-oublie">Mot de passe oublié ?</a></p>
		</form>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('frontendTemplate.php'); ?>