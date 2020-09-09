<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>ToDo - <?= $title ?></title>
        <link rel="stylesheet" href="public/css/frontend.style.css">
    </head>

    <body>
    	<header>
    		<a id="logo" href="<?= LINK_HOME ?>"><img src="public/images/frontend/logo.png" alt="Logo" /></a>
    		<nav>
    			<ul>
    				<li><a href="#">Fonctionnalités</a></li>
    				<li><a href="#">Contact</a></li>
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
    	</header>

    	<?= $content ?>
    </body>
</html>