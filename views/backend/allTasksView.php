<?php $title = "Toutes les tâches"; ?>

<?php ob_start(); ?>

<h1>Toutes les tâches</h1>

<?php if(count($tasks)) { ?>

<section id="all_tasks">
	<table>
		<thead>
			<tr>
				<th>Tâche</th>
				<th>Deadline</th>
				<th>Liste</th>
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
						<?php foreach ($lists as $list) { 
							if ($list->id() === $task->listId()) { ?>.
								<div class="list" list="<?= $list->id() ?>">
									<p class="list-name"><?= $list->name() ?></p>
								</div>
							<?php } ?>
						<?php } ?>
					</td>
					<td>
						<i class="fas fa-edit" title="Modifier"></i>
						<?php if($task->reccuring() == 1) { ?>
							<i class="fas fa-trash delete" title="Supprimer"></i>
						<?php } else { ?>
							<a href="index.php?action=deleteTask&id=<?= $task->id() ?>"><i class="fas fa-trash" title="Supprimer"></i></a>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</section>

<?php } else { ?><p>Pas de tâche.</p><?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>