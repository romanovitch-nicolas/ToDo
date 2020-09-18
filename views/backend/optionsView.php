<?php $title = "Préférences"; ?>

<?php ob_start(); ?>

<h1>Préférences</h1>

<section id="options">
	<?php if (isset($return) && $return !== true) { echo '<p><i class="fas fa-exclamation-circle"></i> ' . $return . '</p>'; } ?>
	<?php if (isset($return) && $return === true) { echo '<p><i class="fas fa-check"></i> Les modifications ont été prises en compte.</p>'; } ?>
	<div class="option">
		<p class="option_button">Modifier mon mot de passe</p>
		<div class="option_content <?php if(($_GET['action'] === 'changePass' && isset($return) && $return === true) || ($_GET['action'] !== 'changePass')) { ?>invisible<?php }?>">
			<form method="POST" action="index.php?action=changePass">
				<table>
					<tr>
						<td>Mot de passe actuel</td>
						<td><input type="password" name="old_pass" maxlength="255" required /></td>
					</tr>
					<tr>
						<td>Nouveau mot de passe</td>
						<td><input type="password"  name="new_pass" maxlength="255" required /></td>
					</tr>
					<tr>
						<td>Confirmation</td>
						<td><input type="password" name="pass_confirm" maxlength="255" required /></td>
					</tr>
				</table>
				<p><input class="button" type="submit" name="change_pass" value="Valider" /></p>
			</form>
		</div>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>