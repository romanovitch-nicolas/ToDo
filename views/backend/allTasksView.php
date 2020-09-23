<?php $title = "Toutes les tâches"; ?>

<?php ob_start(); ?>

<h1>Toutes les tâches <span class="grey">(<?= count($tasks) ?>)</span></h1>

<?php if(count($tasks)) { ?>

<section id="all_tasks">
	<table class="table-task">
		<thead>
			<tr>
				<th>Tâche</th>
				<th>Echéance</th>
				<th>Liste</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tasks as $task) { ?>
				<tr class="task <?php if($task->reccuring() == 1) { ?>reccuring<?php } ?>"
					<?php if($task->reccuring() == 1 && $task->important() == 1) { ?>title="Tâche importante et récurrente [<?= $task->schedule() ?>]"
					<?php } elseif($task->reccuring() == 1) { ?>title="Tâche récurrente [<?= $task->schedule() ?>]"
					<?php } elseif($task->important() == 1) { ?>title="Tâche importante"<?php } ?>>
					<td>
						<input type="checkbox" id="<?= $task->id() ?>" name="<?= $task->id() ?>" <?php if ($task->done() == 1) {?> checked <?php } ?> />
						<label for="<?= $task->id() ?>" important="<?= $task->important() ?>" class="<?php if($task->important() == 1) { ?>active<?php } ?>"><?= $task->name() ?></label>
					</td>
					<td>
						<span class="date <?php if($task->important() == 1) { ?>active<?php } ?>" <?php if($task->reccuring() == 1) { ?> schedule="<?= $task->schedule() ?>"<?php } ?>><?= $task->deadlineDate() ?></span>
					</td>
					<td>
						<?php foreach ($lists as $list) { 
							if ($list->id() === $task->listId()) { ?>
								<div class="list" list="<?= $list->id() ?>">
									<span class="list-name"><?= $list->name() ?></span>
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
	<div class="addtask-all"><i class="fas fa-plus fa-fw"></i> Ajouter une tâche</div>
</section>

<?php } else { ?>
	<p>Pas de tâche.</p>
	<div class="addtask-all"><i class="fas fa-plus fa-fw"></i> Ajouter une tâche</div>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>