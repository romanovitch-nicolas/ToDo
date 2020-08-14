<?php
$title = "Toutes les tâches";
?>

<?php ob_start(); ?>

<h1>Toutes les tâches</h1>

<?php if(count($tasks)) { ?>

<section id="all_tasks">
	<table>
		<thead>
			<tr>
				<th>Tâche</th>
				<th>Deadline</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tasks as $task) { ?>
				<tr class="task">
					<td>
						<input type="checkbox" id="<?= $task->id() ?>" name="<?= $task->id() ?>" <?php if ($task->done() == 1) {?> checked <?php } ?> />
						<label for="<?= $task->id() ?>" important="<?= $task->important() ?>"><?= $task->name() ?></label>
					</td>
					<td>
						<p class="date" <?php if($task->reccuring() == 1) { echo 'schedule="' . $task->schedule() . '"'; } ?>><?= $task->deadlineDate() ?></p>
					</td>
					<td>
						<i class="fas fa-edit" title="Modifier"></i>
						<a href="index.php?action=deleteTask&id=<?= $task->id() ?>"><i class="fas fa-trash" onclick="
							if(<?= $task->reccuring() ?> == 1) {
								if(confirm('Attention, ceci est une tâche récurrente. Pensez à décocher la case \'Répéter\' si vous voulez aussi supprimer les récurrences. Supprimer définitivement ?')){return true;}else{return false;}
							} else if(confirm('Supprimer définitivement ?')){return true;}else{return false;}
							"title="Supprimer"></i></a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</section>

<?php } else { ?><p>Pas de tâche.</p><?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>