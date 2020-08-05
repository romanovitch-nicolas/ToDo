<?php
session_start();

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

//$listController = new Todo\Controllers\ListController();
//$taskController = new Todo\Controllers\TaskController();
$userController = new ToDo\Controllers\UserController();

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'all-tasks':
                require('views/backend/allTasksView.php');
            break;

            case 'dashboard':
                require('views/backend/dashboardView.php');
            break;

            case 'home':
                require('views/frontend/homeView.php');
            break;

            case 'inscription':
                if (!isset($_SESSION['login']) OR !isset($_COOKIE['login'])) {
                    require('views/frontend/inscriptionView.php');
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'register':
                if (!isset($_SESSION['login']) OR !isset($_COOKIE['login'])) {
                    $userController->inscription();
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'connexion':
                if (!isset($_SESSION['login']) OR !isset($_COOKIE['login'])) {
                    require('views/frontend/connectView.php');
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'connect':
                if (!isset($_SESSION['login']) OR !isset($_COOKIE['login'])) {
                    $userController->connexion();
                }
                else {
                    require('views/frontend/homeView.php');
                }
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