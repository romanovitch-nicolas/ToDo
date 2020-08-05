<?php
require_once('include/links.php');

spl_autoload_register(function ($class) {
    $class = str_replace('ToDo\Controllers\\', '', $class);
    $class = str_replace('ToDo\Models\\', '', $class);
    $files = array('controllers/' . $class . '.php', 'models/' . $class . '.php');

    foreach ($files as $file)
    {
        if (file_exists($file))
        {
            require_once $file;
        }
    }
});

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'home':
                require('views/frontend/homeView.php');
            break;

            case 'dashboard':
                require('views/backend/dashboardView.php');
            break;

            case 'all-tasks':
                require('views/backend/allTasksView.php');
            break;

            default:
                require('views/frontend/homeView.php');
            break;
        }
    }
    else {
    	require('views/frontend/homeView.php');
    }
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}