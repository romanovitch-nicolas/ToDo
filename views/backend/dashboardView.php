<?php
$title = "Tableau de Bord";
?>

<?php ob_start(); ?>

<h1>Tableau de Bord</h1>

<section id="dashboard">

	<div id="overview">
		<div>
			<p>
				<?php if($nbTodayAllTasks !== 0) { ?>
					<?= round($nbTodayDoneTasks/$nbTodayAllTasks*100) ?> %
				<?php } else { ?>
					Pas de tâche	
				<?php } ?>
			</p>
			<p>
				<?php if($nbTodayAllTasks !== 0) { ?>
					<?= $nbTodayDoneTasks ?> sur <?= $nbTodayAllTasks ?>
				<?php } else { ?>
					prévue.
				<?php } ?>
			</p>
			<span>Tâches du jour</span>
		</div>
		<div>
			<p><?= $nbDoneTasks ?></p>
			<span>Tâches effectuées</span>
		</div>
		<div>
			<svg style="width:220px; height:120px;">
				<!-- Remplissage -->
				<?php 
					$height = 101;
					$width = 202;
					$x = 9;
					$inc = $width/6;
					$max = max($days);
					$i = -6;
				?>
				<path d="<?php foreach ($days as $dayTasks) {
					$y = ($height - $days[$i] * $height / $max) + 10 ?>
					<?php if($i === -6) { ?>
						M <?= $x ?> <?= $y ?>
					<?php } ?>
					<?php if($i < 0) { ?>
						L <?= $x + $inc ?> <?= ($height - $days[$i + 1] * $height / $max) + 10 ?>
					<?php } ?>
					<?php if($i === 0) { ?>
						L <?= $width + 10 ?> <?= $height + 10 ?> L 10 <?= $height + 10 ?>
					<?php } ?>
					<?php 
						$i = $i + 1; 
						$x = $x + $inc; 
					} ?>
					" class="graph-fill" />	

				<!-- Courbe -->
				<?php 
					$height = 100;
					$width = 200;
					$x = 10;
					$inc = $width/6;
					$max = max($days);
					$i = -6;
				?>
				<path d="<?php foreach ($days as $dayTasks) {
					$y = ($height - $days[$i] * $height / $max) + 10 ?>
					<?php if($i === -6) { ?>
						M <?= $x ?> <?= $y ?>
					<?php } ?>
					<?php if($i < 0) { ?>
						L <?= $x + $inc ?> <?= ($height - $days[$i + 1] * $height / $max) + 10 ?>
					<?php } ?>
					<?php 
						$i = $i + 1; 
						$x = $x + $inc; 
					} ?>
					" class="graph-path" />	

				<!-- Cercles -->
				<?php 
					$height = 100;
					$width = 200;
					$x = 10;
					$inc = $width/6;
					$max = max($days);
					$i = -6;
				?>	
				<?php foreach ($days as $dayTasks) {
					$y = ($height - $days[$i] * $height / $max) + 10 ?>
					<circle cx="<?= $x ?>" cy="<?= $y ?>" r="3" fill="#2A6EC9">
						<title><span class="dateformat"><?= $date[$i] ?></span>,&#10;<?= $days[$i] ?> tâche(s) effectuée(s)</title>
					</circle>
				<?php 
					$i = $i + 1; 
					$x = $x + $inc; 
				} ?>
			</svg>
			<span>Activité des 7 derniers jours</span>
		</div>
	</div>

	<div class="category">
		<h2 class="table-title">Retard <span class="grey">( <?= count($overdueTasks) ?> )</span> <i class="fas fa-caret-up"></i><i class="fas fa-caret-down invisible"></i></h2>
		<div class="display_content">
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
									<i class="fas fa-edit edit" title="Modifier"></i>
									<?php if($overdueTask->reccuring() == 1) { ?>
										<i class="fas fa-trash delete" title="Supprimer"></i>
									<?php } else { ?>
										<a href="index.php?action=deleteTask&id=<?= $overdueTask->id() ?>"><i class="fas fa-trash delete" title="Supprimer"></i></a>
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } else { ?><p>Pas de tâche en retard.</p><?php } ?>
		</div>
	</div>

	<div class="category">
		<h2>Aujourd'hui <span class="dateformat"><?= $todayDate ?></span><span class="grey">( <?= count($todayTasks) ?> )</span> <i class="fas fa-caret-up"></i><i class="fas fa-caret-down invisible"></i></h2>
		<div class="display_content">
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
									<i class="fas fa-edit edit" title="Modifier"></i>
									<?php if($todayTask->reccuring() == 1) { ?>
										<i class="fas fa-trash delete" title="Supprimer"></i>
									<?php } else { ?>
										<a href="index.php?action=deleteTask&id=<?= $todayTask->id() ?>"><i class="fas fa-trash delete" title="Supprimer"></i></a>
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="addtask-today"><i class="fas fa-plus fa-fw"></i> Ajouter une tâche</div>
			<?php } else { ?>
				<p>Pas de tâche prévue aujourd'hui.</p>
				<div class="addtask-today"><i class="fas fa-plus fa-fw"></i> Ajouter une tâche</div>
			<?php } ?>
		</div>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>