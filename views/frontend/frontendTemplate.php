<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>ToDo - <?= $title ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/frontend.style.css">
    </head>

    <body>
    	<header>
    		<a id="logo" href="<?= LINK_HOME ?>"><img src="public/images/frontend/logo.png" alt="Logo" /></a>
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
    	</header>

    	<?= $content ?>

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
        <script src="public/js/frontend.js"></script>
    </body>
</html>