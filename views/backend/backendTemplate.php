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
                    <li><div class="line"></div></li>
    				<li><a href="<?= LINK_ALLTASKS ?>" <?php if($_GET['action'] == 'allTasks') { echo 'class="active"'; } ?>><i class="far fa-list-alt fa-fw"></i>Toutes les tâches</a></li>
    				<li id="nav_important"><a href="<?= LINK_IMPORTANT ?>" <?php if($_GET['action'] == 'important') { echo 'class="active"'; } ?>><i class="fas fa-exclamation-circle fa-fw"></i>Important</a></li>
    				<li id="nav_today"><a href="<?= LINK_TODAY ?>" <?php if($_GET['action'] == 'today') { echo 'class="active"'; } ?>><i class="far fa-calendar fa-fw"></i>Aujourd'hui</a></li>
    				<li id="nav_week"><a href="<?= LINK_WEEK ?>" <?php if($_GET['action'] == 'week') { echo 'class="active"'; } ?>><i class="far fa-calendar-alt fa-fw"></i>7 Prochains Jours</a></li>
    				<li id="nav_overdue"><a href="<?= LINK_OVERDUE ?>" <?php if($_GET['action'] == 'overdue') { echo 'class="active"'; } ?>><i class="far fa-calendar-times fa-fw"></i>Retard</a></li>
    				<li><a href="<?= LINK_ARCHIVES ?>" <?php if($_GET['action'] == 'archives') { echo 'class="active"'; } ?>><i class="fas fa-archive fa-fw"></i>Archives</a></li>
    				<li><div class="line"></div></li>
    				<li><i class="fas fa-list"></i>Listes ▼</li>
    			</ul>
    		</nav>
    	</header>

        <div id="background" class="invisible"></div>
        <div id="task-form" class="invisible">
            <i class="fas fa-times"></i>
            <h2>Ajouter une tâche</h2>
            <form method="POST" action="index.php?action=addTask">
                <p><input type="text" name="task" maxlength="255" required /></p>
                <p>
                    <input type="submit" value="Ajouter" />
                    <span>
                        <i class="fas fa-list"></i>
                        <i class="far fa-clock" id="time"></i>
                        <input type="checkbox" name="important" class="invisible" />
                        <i class="far fa-flag" id="important" title="Important"></i>
                        <i class="fas fa-flag invisible" id="important_active" title="Important"></i>
                    </span>
                </p>
                <p id="time-menu" class="invisible">
                    <input type="checkbox" name="time" />
                    <label for="time">Prévoir pour le :</label>
                    <input type="date" name="deadline" />
                </p>
            </form>
        </div>

        <?= $content ?>

        <div class="invisible">
            <p id="nb_important"><?= $nbImportantTasks ?></p>
            <p id="nb_today"><?= $nbTodayTasks ?></p>
            <p id="nb_week"><?= $nbWeekTasks ?></p>
            <p id="nb_overdue"><?= $nbOverdueTasks ?></p>
        </div>

        <script src="https://kit.fontawesome.com/45b095f08c.js" crossorigin="anonymous"></script>
        <script src="public/js/ajax.js"></script>
        <script src="public/js/form.js"></script>
        <script src="public/js/nav.js"></script>
    </body>
</html>