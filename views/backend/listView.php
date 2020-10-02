<?php
$title = "Listes";
?>

<?php ob_start(); ?>

<h1>Listes</h1>

<section id="list">
	<div id="add-list" class="button">Créer une liste</div>
	<div id="list-form" class="invisible">
		<i class="fas fa-times"></i>
	    <h2>Créer une liste</h2>
		<form method="POST" action="index.php?action=addList">
			<p><input type="text" placeholder="Nom" name="name" maxlength="255" required />
			<textarea placeholder="Description (optionnel)" name="description"></textarea></p>
			<input type="checkbox" name="progress" />
			<label for="progress">Afficher les pourcentages</label>
			<p><input class="button" type="submit" value="Créer" /></p>
		</form>
	</div>

	<?php foreach ($lists as $list) {
		$tasksList = [];
		$tasksDoneList = [];
		foreach ($tasks as $task) {
			if ($task->listId() === $list->id()) {
				array_push($tasksList, $task);
			}
			if ($task->listId() === $list->id() && $task->done() == 1) {
				array_push($tasksDoneList, $task);
			}
		} ?>
		<div class="list" list="<?= $list->id() ?>" progress="<?= $list->progressBar() ?>">
			<h2 class="list-name"><?= $list->name() ?><i class="fas fa-caret-up invisible"></i><i class="fas fa-caret-down"></i></h2>
			<?php if(count($tasksList) && $list->progressBar() == 1){ ?>
				<span class="progress-bar"><span class="progress" style="width: <?= round(count($tasksDoneList)/count($tasksList)*100*1.75) ?>px"></span></span> <span class="grey"><?= round(count($tasksDoneList)/count($tasksList)*100) ?> %</span>
			<?php } ?>
			<div class="display_content invisible">
				<p class="grey"><span class="edit">Modifier</span> - <span class="delete">Supprimer</span></p>
				<p class="list-description"><?= nl2br($list->description()) ?></p>
				<?php if(count($tasksList)) { ?>
					<table class="table-task">
						<thead>
							<th>Tâche</th>
							<th>Echéance</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php foreach ($tasksList as $task) { ?>
								<tr class="task <?php if($task->reccuring() == 1) { ?>reccuring<?php } ?>"
									<?php if($task->reccuring() == 1 && $task->important() == 1) { ?>title="Tâche importante et récurrente [<?= $task->schedule() ?>]"
									<?php } elseif($task->reccuring() == 1) { ?>title="Tâche récurrente [<?= $task->schedule() ?>]"
									<?php } elseif($task->important() == 1) { ?>title="Tâche importante"<?php } ?>>
									<td>
										<input type="checkbox" id="<?= $task->id() ?>" name="<?= $task->id() ?>" <?php if ($task->done() == 1) {?> checked <?php } ?> />
										<label for="<?= $task->id() ?>" important="<?= $task->important() ?>" list="<?= $list->id() ?>" class="<?php if($task->important() == 1) { ?>active<?php } ?>"><?= $task->name() ?></label>
									</td>
									<td>
										<?php if($task->deadlineDate() !== null) { ?><span class="echeance"></span><?php } ?>
										<span class="date <?php if($task->important() == 1) { ?>active<?php } ?>" <?php if($task->reccuring() == 1) { ?> schedule="<?= $task->schedule() ?>"<?php } ?>><?= $task->deadlineDate() ?></span>
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
					<div class="addtask-list"><i class="fas fa-plus fa-fw"></i> Ajouter une tâche</div>
				<?php } else { ?>
					<p>Pas de tâche.</p>
					<div class="addtask-list"><i class="fas fa-plus fa-fw"></i> Ajouter une tâche</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

<?php if(count($lists)) { ?>

<?php } else { ?><p>Pas de liste.</p><?php } ?>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>