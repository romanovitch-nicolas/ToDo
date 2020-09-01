<?php
$title = "Tableau de Bord";
?>

<?php ob_start(); ?>

<h1>Tableau de Bord</h1>

<section id="dashboard">
	<h2>Retard (<?= count($overdueTasks) ?>)</h2>
	<?php if(count($overdueTasks)) { ?>
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
				<?php foreach ($overdueTasks as $overdueTask) { ?>
					<tr class="task">
						<td>
							<input type="checkbox" id="<?= $overdueTask->id() ?>" name="<?= $overdueTask->id() ?>" <?php if ($overdueTask->done() == 1) {?> checked <?php } ?> />
							<label for="<?= $overdueTask->id() ?>" important="<?= $overdueTask->important() ?>"><?= $overdueTask->name() ?></label>
						</td>
						<td>
							<p class="date" <?php if($overdueTask->reccuring() == 1) { echo 'schedule="' . $overdueTask->schedule() . '"'; } ?>><?= $overdueTask->deadlineDate() ?></p>
						</td>
						<td>
							<?php foreach ($lists as $list) { 
								if ($list->id() === $overdueTask->listId()) { ?>
									<p><?= $list->name() ?></p> 
								<?php } ?>
							<?php } ?>
						</td>
						<td>
							<i class="fas fa-edit" title="Modifier"></i>
							<?php if($overdueTask->reccuring() == 1) { ?>
								<i class="fas fa-trash" title="Supprimer"></i>
							<?php } else { ?>
								<a href="index.php?action=deleteTask&id=<?= $overdueTask->id() ?>"><i class="fas fa-trash" title="Supprimer"></i></a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else { ?><p>Pas de tâche en retard.</p><?php } ?>

	<h2>Aujourd'hui (<?= count($todayTasks) ?>)</h2>
	<?php if(count($todayTasks)) { ?>
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
				<?php foreach ($todayTasks as $todayTask) { ?>
					<tr class="task">
						<td>
							<input type="checkbox" id="<?= $todayTask->id() ?>" name="<?= $todayTask->id() ?>" <?php if ($todayTask->done() == 1) {?> checked <?php } ?> />
							<label for="<?= $todayTask->id() ?>" important="<?= $todayTask->important() ?>"><?= $todayTask->name() ?></label>
						</td>
						<td>
							<p class="date" <?php if($todayTask->reccuring() == 1) { echo 'schedule="' . $todayTask->schedule() . '"'; } ?>><?= $todayTask->deadlineDate() ?></p>
						</td>
						<td>
							<?php foreach ($lists as $list) { 
								if ($list->id() === $todayTasks->listId()) { ?>
									<p><?= $list->name() ?></p> 
								<?php } ?>
							<?php } ?>
						</td>
						<td>
							<i class="fas fa-edit" title="Modifier"></i>
							<?php if($todayTask->reccuring() == 1) { ?>
								<i class="fas fa-trash" title="Supprimer"></i>
							<?php } else { ?>
								<a href="index.php?action=deleteTask&id=<?= $todayTask->id() ?>"><i class="fas fa-trash" title="Supprimer"></i></a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else { ?><p>Pas de tâche prévue aujourd'hui.</p><?php } ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>