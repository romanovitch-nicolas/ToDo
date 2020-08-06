<?php
$title = "Toutes les tâches";
?>

<?php ob_start(); ?>

<h1>Toutes les tâches</h1>

<?php
	$taskExist = count($tasks);
	if($taskExist) {
?>

	<table>
		<?php foreach ($tasks as $task) { ?>
			<tr>
				<td>
					<input type="checkbox" id="<?= $task->id() ?>" name="<?= $task->id() ?>" />
					<label for="<?= $task->id() ?>"><?= $task->name() ?></label>
				</td>
				<td>
					<i class="fas fa-edit"></i>
					<a href="index.php?action=deleteTask&id=<?= $task->id() ?>"><i class="fas fa-trash"></i></a>
				</td>
			</tr>
		<?php } ?>
	</table>

<?php } else { ?>
	<p>Pas de tâches.</p>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>