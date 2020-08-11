<?php
$title = "Important";
?>

<?php ob_start(); ?>

<h1>Important</h1>

<?php if(count($tasks)) { ?>

<section id="important">
	<table>
		<?php foreach ($tasks as $task) { ?>
			<tr>
				<td>
					<input type="checkbox" id="<?= $task->id() ?>" name="<?= $task->id() ?>" <?php if ($task->done() == 1) {?> checked <?php } ?> />
					<label for="<?= $task->id() ?>" important="<?= $task->important() ?>"><?= $task->name() ?></label>
				</td>
				<td>
					<p class="date"><?= $task->deadlineDate() ?></p>
				</td>
				<td>
					<i class="fas fa-edit"></i>
					<a href="index.php?action=deleteTask&id=<?= $task->id() ?>"><i class="fas fa-trash"></i></a>
				</td>
			</tr>
		<?php } ?>
	</table>
</section>

<?php } else { ?><p>Pas de tâche importante.</p><?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>