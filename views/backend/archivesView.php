<?php
$title = "Archives";
?>

<?php ob_start(); ?>

<h1>Archives des 30 derniers jours</h1>

<?php if(count($tasks)) { ?>

<section id="archives">
	<table>
		<thead>
			<tr>
				<th>Tâche</th>
				<th>Liste</th>
				<th>Date d'accomplissement</th>
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
						<?php foreach ($lists as $list) { 
							if ($list->id() === $task->listId()) { ?>
								<p><?= $list->name() ?></p> 
							<?php } ?>
						<?php } ?>
					</td>
					<td>
						<p class="date"><?= $task->completionDate() ?></p>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</section>

<?php } else { ?><p>Pas de tâche effectuée.</p><?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>