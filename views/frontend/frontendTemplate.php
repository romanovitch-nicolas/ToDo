<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>ToDo - <?= $title ?></title>
        <link rel="stylesheet" href="public/css/frontend.style.css">
    </head>

    <body>
    	<header>
    		<a id="logo" href="<?= LINK_HOME ?>"><img src="http://placehold.it/250x80" alt="Logo" /></a>
    		<nav>
    			<ul>
    				<li><a href="#">Fonctionnalités</a></li>
    				<li><a href="#">Contact</a></li>
    			</ul>
    			<ul>
    				<li><a href="<?= LINK_CONNEXION ?>">Connexion</a></li>
    				<li><a href="<?= LINK_INSCRIPTION ?>">Inscription</a></li>
    			</ul>
    		</nav>
    	</header>

    	<?= $content ?>
    </body>
</html>