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

$listController = new ToDo\Controllers\ListController();
$taskController = new ToDo\Controllers\TaskController();
$userController = new ToDo\Controllers\UserController();

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'home':
                require('views/frontend/homeView.php');
            break;

            case 'inscription':
                if (!isset($_SESSION['id']) OR !isset($_COOKIE['id'])) {
                    require('views/frontend/inscriptionView.php');
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'register':
                if (!isset($_SESSION['id']) OR !isset($_COOKIE['id'])) {
                    $userController->inscription();
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'connection':
                if (!isset($_SESSION['id']) OR !isset($_COOKIE['id'])) {
                    require('views/frontend/connectView.php');
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'connect':
                if (!isset($_SESSION['id']) OR !isset($_COOKIE['id'])) {
                    $userController->connection();
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'disconnect':
                $userController->disconnection();
            break;

            case 'dashboard':
                if (isset($_SESSION['id']) OR isset($_COOKIE['id'])) {
                    require('views/backend/dashboardView.php');
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'allTasks':
                if (isset($_SESSION['id'])) {
                    $taskController->getAllTasks($_SESSION['id']);
                } 
                elseif (isset($_COOKIE['id'])) {
                    $taskController->getAllTasks($_COOKIE['id']);
                }
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'addTask':
                if (isset($_SESSION['id'])) {
                    $taskController->addTask($_POST['task'], $_SESSION['id'], $_POST['important']);
                }
                elseif (isset($_COOKIE['id'])) {
                    $taskController->addTask($_POST['task'], $_COOKIE['id'], $_POST['important']);
                }
                else {
                    require('views/frontend/connectView.php'); 
                }
            break;

            case 'editTask':
                if (isset($_SESSION['id'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $taskController->editTask($_GET['id'], $_POST['task'], $_SESSION['id'], $_POST['important']);
                    }
                    else
                    {
                        require('views/backend/dashboardView.php');
                    }
                }
                elseif (isset($_COOKIE['id'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $taskController->editTask($_GET['id'], $_POST['task'], $_COOKIE['id'], $_POST['important']);
                    }
                    else
                    {
                        require('views/backend/dashboardView.php');
                    }
                }
                else {
                    require('views/frontend/connectView.php'); 
                }
            break;

            case 'deleteTask':
                if (isset($_SESSION['id'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $taskController->deleteTask($_GET['id'], $_SESSION['id']);
                    }
                    else
                    {
                        require('views/backend/dashboardView.php');
                    }
                }
                elseif (isset($_COOKIE['id'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $taskController->deleteTask($_GET['id'], $_COOKIE['id']);
                    }
                    else
                    {
                        require('views/backend/dashboardView.php');
                    }
                }
                else {
                    require('views/frontend/connectView.php'); 
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