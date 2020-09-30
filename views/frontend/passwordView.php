<?php
$title = "Mot de passe oublié";
?>

<?php ob_start(); ?>

<section id="password">
	<div class="column"></div>
	<div class="blank">
		<h1>Mot de passe oublié</h1>
		<?php 
		if (isset($return) && $return !== true) { 
			echo '<p><i class="fas fa-exclamation-circle red"></i> ' . $return . '</p>';
		} elseif (isset($return) && $return === true) {
			echo '<p><i class="fas fa-check green"></i> Vos identifiants ont été envoyés sur votre boite mail.</a>.</p>';
		} else { 
			echo '<p>Merci de renseigner votre adresse mail afin que nous puissions vous envoyer vos identifiants.</p>';
		} ?>
		<form method="POST" action="verification-mdp-oublie">
			<table>
				<tr>
					<td>Adresse mail</td>
					<td><input type="email" name="mail" maxlength="255" <?php if (isset($_POST['mail'])) { echo 'value="' . $_POST['mail'] . '"'; } ?> required /></td>
				</tr>
				<tr>
					<td></td>
					<td><p class="center"><input class="button" type="submit" name="sendPass" value="Envoyer" /></p></td>
				</tr>
			</table>
		</form>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('frontendTemplate.php'); ?>