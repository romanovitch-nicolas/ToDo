<?php
$title = "Archives";
?>

<?php ob_start(); ?>

<h1>Archives des 30 derniers jours <span class="grey">(<?= count($tasks) ?>)</span></h1>

<?php if(count($tasks)) { ?>

<section id="archives">
	<table class="table-task">
		<thead>
			<tr>
				<th>Tâche</th>
				<th>Liste</th>
				<th>Date d'accomplissement</th>
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
						<?php foreach ($lists as $list) { 
							if ($list->id() === $task->listId()) { ?>
								<div class="list" list="<?= $list->id() ?>">
									<span class="list-name"><?= $list->name() ?></span>
								</div>
							<?php } ?>
						<?php } ?>
					</td>
					<td>
						<span class="date"><?= $task->completionDate() ?></span>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</section>

<?php } else { ?><p>Pas de tâche effectuée.</p><?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>