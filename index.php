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
                if (isset($_SESSION['id'])) {
                    $taskController->getDashboard($_SESSION['id']);
                } 
                elseif (isset($_COOKIE['id'])) {
                    $taskController->getDashboard($_COOKIE['id']);
                }
                else {
                    require('views/frontend/connectView.php');
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

            case 'important':
                if (isset($_SESSION['id'])) {
                    $taskController->getImportantTasks($_SESSION['id']);
                } 
                elseif (isset($_COOKIE['id'])) {
                    $taskController->getImportantTasks($_COOKIE['id']);
                }
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'today':
                if (isset($_SESSION['id'])) {
                    $taskController->getTodayTasks($_SESSION['id']);
                } 
                elseif (isset($_COOKIE['id'])) {
                    $taskController->getTodayTasks($_COOKIE['id']);
                }
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'week':
                if (isset($_SESSION['id'])) {
                    $taskController->getWeekTasks($_SESSION['id']);
                } 
                elseif (isset($_COOKIE['id'])) {
                    $taskController->getWeekTasks($_COOKIE['id']);
                }
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'overdue':
                if (isset($_SESSION['id'])) {
                    $taskController->getOverdueTasks($_SESSION['id']);
                } 
                elseif (isset($_COOKIE['id'])) {
                    $taskController->getOverdueTasks($_COOKIE['id']);
                }
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'archives':
                if (isset($_SESSION['id'])) {
                    $taskController->getArchivedTasks($_SESSION['id']);
                } 
                elseif (isset($_COOKIE['id'])) {
                    $taskController->getArchivedTasks($_COOKIE['id']);
                }
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'addTask':
                if (isset($_SESSION['id'])) {
                    $taskController->addTask($_POST['task'], $_SESSION['id'], $_POST['important'], $_POST['time'], $_POST['deadline']);
                }
                elseif (isset($_COOKIE['id'])) {
                    $taskController->addTask($_POST['task'], $_COOKIE['id'], $_POST['important'], $_POST['time'], $_POST['deadline']);
                }
                else {
                    require('views/frontend/connectView.php'); 
                }
            break;

            case 'editTask':
                if (isset($_SESSION['id'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (isset($_POST['important'])) { $important = $_POST['important']; } else { $important = 0; };
                        if (isset($_POST['time'])) { $time = $_POST['time']; } else { $time = false; };
                        $taskController->editTask($_GET['id'], $_POST['task'], $_SESSION['id'], $important, $time, $_POST['deadline']);
                    }
                    else
                    {
                        require('views/backend/dashboardView.php');
                    }
                }
                elseif (isset($_COOKIE['id'])) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (isset($_POST['important'])) { $important = $_POST['important']; } else { $important = 0; };
                        if (isset($_POST['time'])) { $time = $_POST['time']; } else { $time = false; };
                        $taskController->editTask($_GET['id'], $_POST['task'], $_COOKIE['id'], $important, $time, $_POST['deadline']);
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