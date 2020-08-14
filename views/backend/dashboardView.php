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
							<i class="fas fa-edit" title="Modifier"></i>
							<a href="index.php?action=deleteTask&id=<?= $overdueTask->id() ?>"><i class="fas fa-trash" onclick="
								if(<?= $overdueTask->reccuring() ?> == 1) {
									if(confirm('Attention, ceci est une tâche récurrente. Pensez à décocher la case \'Répéter\' si vous voulez aussi supprimer les récurrences. Supprimer définitivement ?')){return true;}else{return false;}
								} else if(confirm('Supprimer définitivement ?')){return true;}else{return false;}
								"title="Supprimer"></i></a>
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
							<i class="fas fa-edit" title="Modifier"></i>
							<a href="index.php?action=deleteTask&id=<?= $todayTask->id() ?>"><i class="fas fa-trash" onclick="
								if(<?= $todayTask->reccuring() ?> == 1) {
									if(confirm('Attention, ceci est une tâche récurrente. Pensez à décocher la case \'Répéter\' si vous voulez supprimer les récurrences. Supprimer définitivement ?')){return true;}else{return false;}
								} else if(confirm('Supprimer définitivement ?')){return true;}else{return false;}
								"title="Supprimer"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else { ?><p>Pas de tâche prévue aujourd'hui.</p><?php } ?>

	<h2>Important (<?= count($importantTasks) ?>)</h2>
	<?php if(count($importantTasks)) { ?>
		<table>
			<thead>
				<tr>
					<th>Tâche</th>
					<th>Deadline</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($importantTasks as $importantTask) { ?>
					<tr class="task">
						<td>
							<input type="checkbox" id="<?= $importantTask->id() ?>" name="<?= $importantTask->id() ?>" <?php if ($importantTask->done() == 1) {?> checked <?php } ?> />
							<label for="<?= $importantTask->id() ?>" important="<?= $importantTask->important() ?>"><?= $importantTask->name() ?></label>
						</td>
						<td>
							<p class="date" <?php if($importantTask->reccuring() == 1) { echo 'schedule="' . $importantTask->schedule() . '"'; } ?>><?= $importantTask->deadlineDate() ?></p>
						</td>
						<td>
							<i class="fas fa-edit" title="Modifier"></i>
							<a href="index.php?action=deleteTask&id=<?= $importantTask->id() ?>"><i class="fas fa-trash" onclick="
								if(<?= $importantTask->reccuring() ?> == 1) {
									if(confirm('Attention, ceci est une tâche récurrente. Pensez à décocher la case \'Répéter\' si vous voulez supprimer les récurrences. Supprimer définitivement ?')){return true;}else{return false;}
								} else if(confirm('Supprimer définitivement ?')){return true;}else{return false;}
								"title="Supprimer"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else { ?><p>Pas de tâche importante.</p><?php } ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>