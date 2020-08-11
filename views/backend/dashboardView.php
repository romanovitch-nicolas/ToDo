<?php
$title = "Tableau de Bord";
?>

<?php ob_start(); ?>

<h1>Tableau de Bord</h1>

<section id="dashboard">
	<h2>Retard (<?= count($overdueTasks) ?>)</h2>
	<?php if(count($overdueTasks)) { ?>
		<table>
			<?php foreach ($overdueTasks as $overdueTask) { ?>
				<tr>
					<td>
						<input type="checkbox" id="<?= $overdueTask->id() ?>" name="<?= $overdueTask->id() ?>" <?php if ($overdueTask->done() == 1) {?> checked <?php } ?> />
						<label for="<?= $overdueTask->id() ?>" important="<?= $overdueTask->important() ?>"><?= $overdueTask->name() ?></label>
					</td>
					<td>
						<p class="date"><?= $overdueTask->deadlineDate() ?></p>
					</td>
					<td>
						<i class="fas fa-edit"></i>
						<a href="index.php?action=deleteTask&id=<?= $overdueTask->id() ?>"><i class="fas fa-trash"></i></a>
					</td>
				</tr>
			<?php } ?>
		</table>
	<?php } else { ?><p>Pas de tâche en retard.</p><?php } ?>

	<h2>Aujourd'hui (<?= count($todayTasks) ?>)</h2>
	<?php if(count($todayTasks)) { ?>
		<table>
			<?php foreach ($todayTasks as $todayTask) { ?>
				<tr>
					<td>
						<input type="checkbox" id="<?= $todayTask->id() ?>" name="<?= $todayTask->id() ?>" <?php if ($todayTask->done() == 1) {?> checked <?php } ?> />
						<label for="<?= $todayTask->id() ?>" important="<?= $todayTask->important() ?>"><?= $todayTask->name() ?></label>
					</td>
					<td>
						<p class="date"><?= $todayTask->deadlineDate() ?></p>
					</td>
					<td>
						<i class="fas fa-edit"></i>
						<a href="index.php?action=deleteTask&id=<?= $todayTask->id() ?>"><i class="fas fa-trash"></i></a>
					</td>
				</tr>
			<?php } ?>
		</table>
	<?php } else { ?><p>Pas de tâche prévue aujourd'hui.</p><?php } ?>

	<h2>Important (<?= count($importantTasks) ?>)</h2>
	<?php if(count($importantTasks)) { ?>
		<table>
			<?php foreach ($importantTasks as $importantTask) { ?>
				<tr>
					<td>
						<input type="checkbox" id="<?= $importantTask->id() ?>" name="<?= $importantTask->id() ?>" <?php if ($importantTask->done() == 1) {?> checked <?php } ?> />
						<label for="<?= $importantTask->id() ?>" important="<?= $importantTask->important() ?>"><?= $importantTask->name() ?></label>
					</td>
					<td>
						<p class="date"><?= $importantTask->deadlineDate() ?></p>
					</td>
					<td>
						<i class="fas fa-edit"></i>
						<a href="index.php?action=deleteTask&id=<?= $importantTask->id() ?>"><i class="fas fa-trash"></i></a>
					</td>
				</tr>
			<?php } ?>
		</table>
	<?php } else { ?><p>Pas de tâche importante.</p><?php } ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>