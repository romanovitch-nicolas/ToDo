<?php $title = "Recherche"; ?>

<?php ob_start(); ?>

<h1>Recherche</h1>

<h2><?= count($tasks) + count($achievedTasks) ?> résultat(s) pour la recherche "<?= $search ?>".</h2>

<section id="search">

<?php if(count($tasks)) { ?>
	<p>Tâche(s) non terminée(s) :</p>
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
						<?php if($task->deadlineDate() !== null) { ?><span class="echeance"></span><?php } ?>
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
						<i class="fas fa-edit edit" title="Modifier"></i>
						<?php if($task->reccuring() == 1) { ?>
							<i class="fas fa-trash delete" title="Supprimer"></i>
						<?php } else { ?>
							<a href="index.php?action=deleteTask&id=<?= $task->id() ?>"><i class="fas fa-trash delete" title="Supprimer"></i></a>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>

<?php if(count($achievedTasks)) { ?>
	<p>Archives :</p>
	<table class="table-task">
		<thead>
			<tr>
				<th>Tâche</th>
				<th>Liste</th>
				<th>Date d'accomplissement</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($achievedTasks as $achievedTask) { ?>
				<tr class="task <?php if($achievedTask->reccuring() == 1) { ?>reccuring<?php } ?>"
					<?php if($achievedTask->reccuring() == 1 && $achievedTask->important() == 1) { ?>title="Tâche importante et récurrente [<?= $achievedTask->schedule() ?>]"
					<?php } elseif($achievedTask->reccuring() == 1) { ?>title="Tâche récurrente [<?= $achievedTask->schedule() ?>]"
					<?php } elseif($achievedTask->important() == 1) { ?>title="Tâche importante"<?php } ?>>
					<td>
						<input type="checkbox" id="<?= $achievedTask->id() ?>" name="<?= $achievedTask->id() ?>" <?php if ($achievedTask->done() == 1) {?> checked <?php } ?> />
						<label for="<?= $achievedTask->id() ?>" important="<?= $achievedTask->important() ?>" class="<?php if($achievedTask->important() == 1) { ?>active<?php } ?>"><?= $achievedTask->name() ?></label>
					</td>
					<td>
						<?php foreach ($lists as $list) { 
							if ($list->id() === $achievedTask->listId()) { ?>
								<div class="list" list="<?= $list->id() ?>">
									<span class="list-name"><?= $list->name() ?></span>
								</div>
							<?php } ?>
						<?php } ?>
					</td>
					<td>
						<?php if($achievedTask->completionDate() !== null) { ?><span class="accomplissement"></span><?php } ?>
						<span class="date"><?= $achievedTask->completionDate() ?></span>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>