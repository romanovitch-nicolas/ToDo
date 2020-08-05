<?php
$title = "Connexion";
?>

<?php ob_start(); ?>

<h1>Connexion</h1>

<section id="connexion">
	<?php if (isset($return)) { echo '<p><i class="fas fa-exclamation-circle"></i> ' . $return . '</p>'; } ?>
	<form method="POST" action="index.php?action=connect">
		<table>
			<tr>
				<td><label for="login">Identifiant</label></td>
				<td><input type="text" name="login" maxlength="255" required /></td>
			</tr>
			<tr>
				<td><label for="pass">Mot de passe</label></td>
				<td><input type="password" name="pass" maxlength="255" required /></td>
			</tr>
			<tr>
				<td><label for="autoconnect">Rester connecté</label></td>
				<td><input type="checkbox" name="autoconnect" /></td>
			</tr>
		</table>
		<p><input type="submit" name="connexion" value="Se connecter" /></p>
	</form>
	<p>Pas encore inscrit ?</p>
	<p>Mot de passe oublié ?</p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('frontendTemplate.php'); ?>