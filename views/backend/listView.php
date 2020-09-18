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
			<p><input class="button" type="submit" value="Créer" /></p>
		</form>
	</div>

		<?php foreach ($lists as $list) { ?>
			<div class="list" list="<?= $list->id() ?>">
				<h2 class="list-name"><?= $list->name() ?></h2>
				<p class="grey"><span class="edit">Modifier</span> - <span class="delete">Supprimer</span></p>
				<p class="list-description"><?= nl2br($list->description()) ?></p>
				<?php if(count($tasks)) { ?>
					<table class="table-task">
						<thead>
							<th>Tâche</th>
							<th>Echéance</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php foreach ($tasks as $task) { ?>
								<?php if ($task->listId() === $list->id()) { ?>
								<tr class="task <?php if($task->reccuring() == 1) { ?>reccuring<?php } ?>"
									<?php if($task->reccuring() == 1 && $task->important() == 1) { ?>title="Tâche importante et récurrente [<?= $task->schedule() ?>]"
									<?php } elseif($task->reccuring() == 1) { ?>title="Tâche récurrente [<?= $task->schedule() ?>]"
									<?php } elseif($task->important() == 1) { ?>title="Tâche importante"<?php } ?>>
									<td>
										<input type="checkbox" id="<?= $task->id() ?>" name="<?= $task->id() ?>" <?php if ($task->done() == 1) {?> checked <?php } ?> />
										<label for="<?= $task->id() ?>" important="<?= $task->important() ?>" list="<?= $list->id() ?>" class="<?php if($task->important() == 1) { ?>active<?php } ?>"><?= $task->name() ?></label>
									</td>
									<td>
										<span class="date <?php if($task->important() == 1) { ?>active<?php } ?>" <?php if($task->reccuring() == 1) { ?> schedule="<?= $task->schedule() ?>"<?php } ?>><?= $task->deadlineDate() ?></span>
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
							<?php } ?>
						</tbody>
					</table>
					<div class="addtask-list"><i class="fas fa-plus fa-fw"></i> Ajouter une tâche</div>
				<?php } else { ?>
					<p>Pas de tâche.</p>
					<p><div class="addtask-list"><i class="fas fa-plus fa-fw"></i> Ajouter une tâche</div></p>
				<?php } ?>
			</div>
		<?php } ?>

<?php if(count($lists)) { ?>

<?php } else { ?><p>Pas de liste.</p><?php } ?>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>