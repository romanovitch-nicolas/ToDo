<?php
$title = "Tableau de Bord";
?>

<?php ob_start(); ?>

<h1>Tableau de Bord</h1>

<section id="dashboard">
	<h2>Retard</h2>
	<?php if(count($overdueTasks)) { ?>
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
				<?php foreach ($overdueTasks as $overdueTask) { ?>
					<tr class="task <?php if($overdueTask->reccuring() == 1) { ?>reccuring<?php } ?>"
						<?php if($overdueTask->reccuring() == 1 && $overdueTask->important() == 1) { ?>title="Tâche importante et récurrente [<?= $overdueTask->schedule() ?>]"
						<?php } elseif($overdueTask->reccuring() == 1) { ?>title="Tâche récurrente [<?= $overdueTask->schedule() ?>]"
						<?php } elseif($overdueTask->important() == 1) { ?>title="Tâche importante"<?php } ?>>
						<td>
							<input type="checkbox" id="<?= $overdueTask->id() ?>" name="<?= $overdueTask->id() ?>" <?php if ($overdueTask->done() == 1) {?> checked <?php } ?> />
							<label for="<?= $overdueTask->id() ?>" important="<?= $overdueTask->important() ?>" class="<?php if($overdueTask->important() == 1) { ?>active<?php } ?>"><?= $overdueTask->name() ?></label>
						</td>
						<td>
							<span class="date <?php if($overdueTask->important() == 1) { ?>active<?php } ?>" <?php if($overdueTask->reccuring() == 1) { ?> schedule="<?= $overdueTask->schedule() ?>"<?php } ?>><?= $overdueTask->deadlineDate() ?></span>
						</td>
						<td>
							<?php foreach ($lists as $list) { 
								if ($list->id() === $overdueTask->listId()) { ?>
									<div class="list" list="<?= $list->id() ?>">
										<span class="list-name"><?= $list->name() ?></span>
									</div>
								<?php } ?>
							<?php } ?>
						</td>
						<td>
							<i class="fas fa-edit" title="Modifier"></i>
							<?php if($overdueTask->reccuring() == 1) { ?>
								<i class="fas fa-trash delete" title="Supprimer"></i>
							<?php } else { ?>
								<a href="index.php?action=deleteTask&id=<?= $overdueTask->id() ?>"><i class="fas fa-trash" title="Supprimer"></i></a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else { ?><p>Pas de tâche en retard.</p><?php } ?>

	<h2>Aujourd'hui <span class="dateformat"><?= $todayDate ?></span></h2>
	<?php if(count($todayTasks)) { ?>
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
				<?php foreach ($todayTasks as $todayTask) { ?>
					<tr class="task <?php if($todayTask->reccuring() == 1) { ?>reccuring<?php } ?>"
						<?php if($todayTask->reccuring() == 1 && $todayTask->important() == 1) { ?>title="Tâche importante et récurrente [<?= $todayTask->schedule() ?>]"
						<?php } elseif($todayTask->reccuring() == 1) { ?>title="Tâche récurrente [<?= $todayTask->schedule() ?>]"
						<?php } elseif($todayTask->important() == 1) { ?>title="Tâche importante"<?php } ?>>
						<td>
							<input type="checkbox" id="<?= $todayTask->id() ?>" name="<?= $todayTask->id() ?>" <?php if ($todayTask->done() == 1) {?> checked <?php } ?> />
							<label for="<?= $todayTask->id() ?>" important="<?= $todayTask->important() ?>" class="<?php if($todayTask->important() == 1) { ?>active<?php } ?>"><?= $todayTask->name() ?></label>
						</td>
						<td>
							<span class="date <?php if($todayTask->important() == 1) { ?>active<?php } ?>" <?php if($todayTask->reccuring() == 1) { ?> schedule="<?= $todayTask->schedule() ?>"<?php } ?>><?= $todayTask->deadlineDate() ?></span>
						</td>
						<td>
							<?php foreach ($lists as $list) { 
								if ($list->id() === $todayTask->listId()) { ?>
									<div class="list" list="<?= $list->id() ?>">
										<span class="list-name"><?= $list->name() ?></span>
									</div>
								<?php } ?>
							<?php } ?>
						</td>
						<td>
							<i class="fas fa-edit" title="Modifier"></i>
							<?php if($todayTask->reccuring() == 1) { ?>
								<i class="fas fa-trash delete" title="Supprimer"></i>
							<?php } else { ?>
								<a href="index.php?action=deleteTask&id=<?= $todayTask->id() ?>"><i class="fas fa-trash" title="Supprimer"></i></a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<div class="addtask-today"><i class="fas fa-plus fa-fw"></i> Ajouter une tâche</div>
	<?php } else { ?>
		<p>Pas de tâche prévue aujourd'hui.</p>
		<p><div class="addtask-today"><i class="fas fa-plus fa-fw"></i> Ajouter une tâche</div></p>
	<?php } ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>