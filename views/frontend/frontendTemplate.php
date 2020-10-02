<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="public/images/favicon.png" />
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/frontend.style.css">
        <title>TOOD - <?= $title ?></title>
        <meta name="description" content="Tood est une application de 'To Do List'. Simple d'utilisation et entièrement gratuite, elle vous aidera à organiser votre quotidien." />
        <meta property="og:title" content="TOOD - Organisez votre quotidien" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="http://www.tood.me/" />
        <meta property="og:image" content="https://nsm09.casimages.com/img/2020/09/29//20092905420225240717057270.png" />
        <meta property="og:description" content="Tood est une application de 'To Do List'. Simple d'utilisation et entièrement gratuite, elle vous aidera à organiser votre quotidien." />
    </head>

    <body>
    	<header>
    		<a id="logo" href="<?php if (isset($_GET['action'])) { echo(LINK_HOME); } else { echo(LINK_HOME_TOP); } ?>"><img src="public/images/frontend/logo.png" alt="Logo" /></a>
    		<nav>
    			<ul>
    				<li><a href="<?= LINK_FEATURES ?>">Fonctionnalités</a></li>
    				<li><a href="<?= LINK_CONTACT ?>">Contact</a></li>
    			</ul>
                <?php if (isset($_SESSION['id']) OR isset($_COOKIE['id'])) { ?>
                    <ul>
                        <li><a href="<?= LINK_DASHBOARD ?>">Tableau de Bord</a></li>
                        <li><a href="index.php?action=disconnect">Déconnexion</a></li>
                    </ul>
                <?php } else { ?>
                    <ul>
                        <li><a href="<?= LINK_CONNECTION ?>">Connexion</a></li>
                        <li><a href="<?= LINK_INSCRIPTION ?>">Inscription</a></li>
                    </ul>
                <?php } ?>
    		</nav>
            <i class="fas fa-bars fa-2x"></i>
    	</header>

    	<?= $content ?>

        <div id="cookies" <?php if(isset($_COOKIE['cookies'])) { echo 'class="invisible"'; } ?>>
            <p>Ce site utilise des cookies afin d'analyser le taux de fréquentation, et identifier d'éventuels soucis de navigation.</p>
            <p><span id="accept_cookies" class="button">Accepter</span><span id="refuse_cookies" class="button">Refuser</span><a href="mentions-legales">En savoir plus</a></p>
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
        <script src="public/js/cookies.js"></script>
        <script src="public/js/frontend.js"></script>
    </body>
</html>