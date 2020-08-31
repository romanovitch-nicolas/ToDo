<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>ToDo - <?= $title ?></title>
        <link rel="stylesheet" href="public/css/backend.style.css">
    </head>
    <body>
    	<header>
    		<nav id="top-nav">
    			<a id="logo" href="<?= LINK_HOME ?>"><img src="http://placehold.it/125x40" alt="Logo" /></a>
    			<ul>
    				<li><i class="fas fa-plus fa-fw" title="Ajouter une tâche"></i></li>
    				<li><a href="#"><i class="fas fa-cog fa-fw" title="Préférences"></i></a></li>
    			</ul>
    		</nav>
    		<nav id="left-nav">
    			<ul>
                    <li><a href="<?= LINK_DASHBOARD ?>" <?php if($_GET['action'] == 'dashboard') { echo 'class="active"'; } ?>><i class="fas fa-chart-line fa-fw" title="Tableau de bord"></i>Tableau de bord</a></li>
                    <li><a href="<?= LINK_LISTS ?>" <?php if($_GET['action'] == 'lists') { echo 'class="active"'; } ?>><i class="fas fa-list"></i>Listes</a></li>
                    <li><div class="line"></div></li>
    				<li><a href="<?= LINK_ALLTASKS ?>" <?php if($_GET['action'] == 'allTasks') { echo 'class="active"'; } ?>><i class="far fa-list-alt fa-fw"></i>Toutes les tâches</a><span> (<?= $nbTasks ?>)</span></li>
    				<li><a href="<?= LINK_IMPORTANT ?>" <?php if($_GET['action'] == 'important') { echo 'class="active"'; } ?>><i class="fas fa-exclamation-circle fa-fw"></i>Important</a><span> (<?= $nbImportantTasks ?>)</span></li>
    				<li><a href="<?= LINK_TODAY ?>" <?php if($_GET['action'] == 'today') { echo 'class="active"'; } ?>><i class="far fa-calendar fa-fw"></i>Aujourd'hui</a><span> (<?= $nbTodayTasks ?>)</span></li>
    				<li><a href="<?= LINK_WEEK ?>" <?php if($_GET['action'] == 'week') { echo 'class="active"'; } ?>><i class="far fa-calendar-alt fa-fw"></i>7 Prochains Jours</a><span> (<?= $nbWeekTasks ?>)</span></li>
    				<li><a href="<?= LINK_OVERDUE ?>" <?php if($_GET['action'] == 'overdue') { echo 'class="active"'; } ?>><i class="far fa-calendar-times fa-fw"></i>Retard</a><span> (<?= $nbOverdueTasks ?>)</span></li>
    				<li><a href="<?= LINK_ARCHIVES ?>" <?php if($_GET['action'] == 'archives') { echo 'class="active"'; } ?>><i class="fas fa-archive fa-fw"></i>Archives</a><span> (<?= $nbArchivedTasks ?>)</span></li>		
    			</ul>
    		</nav>
    	</header>

        <div id="background" class="invisible"></div>
        <div id="task-form" class="invisible">
            <i class="fas fa-times"></i>
            <h2>Ajouter une tâche</h2>
            <form method="POST" action="index.php?action=addTask">
                <p><input type="text" name="task" maxlength="255" placeholder="Nom" required /></p>
                <p>
                    <input type="submit" value="Ajouter" />
                    <span>
                        <i class="fas fa-list" id="list"></i>
                        <i class="far fa-clock" id="time"></i>
                        <input type="checkbox" name="important" class="invisible" />
                        <i class="far fa-flag" id="important" title="Important"></i>
                        <i class="fas fa-flag invisible" id="important_active" title="Important"></i>
                    </span>
                </p>
                <div id="time-menu" class="invisible">
                    <p>
                        <input id="deadline_checkbox" type="checkbox" name="time" />
                        <label for="time">Prévoir pour le :</label>
                        <input type="date" name="deadline" />
                    </p>
                    <p>
                        <input id="reccuring_checkbox" type="checkbox" name="reccuring" />
                        <label id="reccuring_label" for="reccuring">Répéter tous les :</label>
                        <input type="number" name="schedule_number" min="1" max="999" />
                        <select id="schedule_delay" name="schedule_delay">
                            <option value="day">jours</option>
                            <option value="week">semaines</option>
                            <option value="month">mois</option>
                            <option value="year">ans</option>
                        </select>
                    </p>
                </div>
                <div id="list-menu" class="invisible">
                    <p>
                        <input id="list_checkbox" type="checkbox" name="list" />
                        <label for="list">Assigner une liste :</label>
                        <select id="list_select" name="list_select">
                            <option></option>
                            <?php foreach ($lists as $list) { ?>
                                <option value="<?= $list->id() ?>"><?= $list->name() ?></option> 
                            <?php } ?>
                        </select>
                    </p>
                </div>
            </form>
        </div>

        <div id="popup" class="invisible">
            <i class="fas fa-times"></i>
            <h2>Attention :</h2>
            <p>Supprimer définitivement ?</p>
            <p><a id="yes" href="#">Oui</a><a id="no" href="#">Non</a></p>
        </div>

        <?= $content ?>

        <script src="https://kit.fontawesome.com/45b095f08c.js" crossorigin="anonymous"></script>
        <script src="public/js/ajax.js"></script>
        <script src="public/js/form.js"></script>
    </body>
</html>