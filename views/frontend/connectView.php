<?php
$title = "Connexion";
?>

<?php ob_start(); ?>

<section id="connexion">
	<div class="column"></div>
	<div class="blank">
		<h1>Connexion</h1>
		<?php if (isset($return)) { echo '<p class="return"><i class="fas fa-exclamation-circle red"></i> ' . $return . '</p>'; } ?>
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
				<tr>
					<td></td>
					<td><p class="center"><input class="button" type="submit" name="connexion" value="Se connecter" /></p></td>
				</tr>
				<tr>
					<td></td>
					<td><p class="center"><a href="<?= LINK_INSCRIPTION ?>">Pas encore inscrit ?</a></p></td>
				</tr>
				<tr>
					<td></td>
					<td><p class="center"><a href="#">Mot de passe oublié ?</a></p></td>
				</tr>
			</table>
		</form>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('frontendTemplate.php'); ?>