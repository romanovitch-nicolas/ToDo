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
    			<a id="logo" href="<?= LINK_HOME ?>"><img src="public/images/backend/logo.png" alt="Logo" /></a>
                <form method="POST" action="<?= LINK_SEARCH ?>" id="search"><i class="fas fa-search"></i><input type="search" name="search" placeholder="Recherche..." required /><input type="submit" class="invisible" /></form>
    			<ul>
    				<li><i class="fas fa-plus fa-fw" title="Ajouter une tâche"></i></li>
    				<li><i class="fas fa-cog fa-fw" title="Préférences"></i></li>
    			</ul>
                <ul id="submenu" class="invisible">
                    <li><a href="<?= LINK_OPTIONS ?>">Préférences</a></li>
                    <li><a href="index.php?action=disconnect">Se déconnecter</a></li>
                </ul>
    		</nav>
    		<nav id="left-nav">
    			<ul>
                    <li><span class="dateformat"><?= $todayDate ?></span></li>
                    <li><div class="line"></div></li>
                    <li><a href="<?= LINK_DASHBOARD ?>" <?php if($_GET['action'] == 'dashboard') { echo 'class="active"'; } ?>><i class="fas fa-chart-line fa-fw" title="Tableau de bord"></i>Tableau de bord</a></li>
                    <li><a href="<?= LINK_LISTS ?>" <?php if($_GET['action'] == 'lists') { echo 'class="active"'; } ?>><i class="fas fa-list fa-fw"></i>Listes</a></li>
                    <li><div class="line"></div></li>
    				<li><a href="<?= LINK_ALLTASKS ?>" <?php if($_GET['action'] == 'allTasks') { echo 'class="active"'; } ?>><i class="far fa-list-alt fa-fw"></i>Toutes les tâches</a><span class="grey"> (<?= $nbTasks ?>)</span></li>
    				<li><a href="<?= LINK_IMPORTANT ?>" <?php if($_GET['action'] == 'important') { echo 'class="active"'; } ?>><i class="far fa-flag fa-fw"></i>Important</a><span class="grey"> (<?= $nbImportantTasks ?>)</span></li>
    				<li><a href="<?= LINK_TODAY ?>" <?php if($_GET['action'] == 'today') { echo 'class="active"'; } ?>><i class="far fa-calendar fa-fw"></i>Aujourd'hui</a><span class="grey"> (<?= $nbTodayTasks ?>)</span></li>
    				<li><a href="<?= LINK_WEEK ?>" <?php if($_GET['action'] == 'week') { echo 'class="active"'; } ?>><i class="far fa-calendar-alt fa-fw"></i>7 Prochains Jours</a><span class="grey"> (<?= $nbWeekTasks ?>)</span></li>
    				<li><a href="<?= LINK_OVERDUE ?>" <?php if($_GET['action'] == 'overdue') { echo 'class="active"'; } ?>><i class="far fa-calendar-times fa-fw"></i>Retard</a><span class="grey"> (<?= $nbOverdueTasks ?>)</span></li>
    				<li><a href="<?= LINK_ARCHIVES ?>" <?php if($_GET['action'] == 'archives') { echo 'class="active"'; } ?>><i class="fas fa-archive fa-fw"></i>Archives</a><span class="grey"> (<?= $nbArchivedTasks ?>)</span></li>		
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
                    <input class="button" type="submit" value="Ajouter" />
                    <span>
                        <i class="fas fa-list" id="list" title="Liste"></i>
                        <i class="far fa-clock" id="time" title="Date"></i>
                        <input type="checkbox" name="important" class="invisible" />
                        <i class="far fa-flag" id="important" title="Important"></i>
                        <i class="fas fa-flag invisible blue" id="important_active" title="Important"></i>
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
                    <div>
                        <p>
                            <input id="list_checkbox" type="checkbox" name="list" />
                            <label for="list">Assigner une liste :</label>
                            <select id="list_select" name="list_select">
                                <option></option>
                                <?php foreach ($lists as $list) { ?>
                                    <option value="<?= $list->id() ?>"><?= $list->name() ?></option> 
                                <?php } ?>
                                <option value="0">-- Créer une liste --</option>
                            </select>
                        </p>
                    </div>
                    <p id="new_list" class="invisible">
                        <label for="list">Nom de la liste :</label>
                        <input type="text" name="new_list" />
                    </p>
                </div>
            </form>
        </div>

        <div id="popup" class="invisible">
            <i class="fas fa-times"></i>
            <h2>Attention</h2>
            <p>Supprimer définitivement ?</p>
            <p><a class="button" id="yes" href="#">Oui</a><a class="button" id="no" href="#">Non</a></p>
        </div>

        <div id="content">
            <?= $content ?>
        </div>

        <footer>
            <ul>
                <li><a href="<?= LINK_HOME ?>">TOOD</a></li>
                <li> | </li>
                <li><a href="<?= LINK_FEATURES ?>">Fonctionnalités</a></li>
                <li> | </li>
                <li><a href="<?= LINK_CONTACT ?>">Contact</a></li>
                <li> | </li>
                <li><a href="<?= LINK_LEGAL ?>">Mentions légales</a></li>
            </ul>
            <select>
                <option value="fr">Français</option>
            </select>
        </footer>

        <script src="https://kit.fontawesome.com/45b095f08c.js" crossorigin="anonymous"></script>
        <script src="public/js/ajax.js"></script>
        <script src="public/js/app.js"></script>
        <script src="public/js/form.js"></script>
        <script src="public/js/nav.js"></script>
    </body>
</html>