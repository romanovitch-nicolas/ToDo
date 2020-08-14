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

if (isset($_SESSION['id']))
{
    $userId = $_SESSION['id'];
}
elseif (isset($_COOKIE['id']))
{
    $userId = $_COOKIE['id'];
}

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'home':
                require('views/frontend/homeView.php');
            break;

            case 'inscription':
                if (empty($userId)) {
                    require('views/frontend/inscriptionView.php');
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'register':
                if (empty($userId)) {
                    $userController->inscription();
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'connection':
                if (empty($userId)) {
                    require('views/frontend/connectView.php');
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'connect':
                if (empty($userId)) {
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
                if (!empty($userId)) {
                    $taskController->getDashboard($userId);
                } 
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'allTasks':
                if (!empty($userId)) {
                    $taskController->getAllTasks($userId);
                } 
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'important':
                if (!empty($userId)) {
                    $taskController->getImportantTasks($userId);
                } 
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'today':
                if (!empty($userId)) {
                    $taskController->getTodayTasks($userId);
                } 
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'week':
                if (!empty($userId)) {
                    $taskController->getWeekTasks($userId);
                } 
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'overdue':
                if (!empty($userId)) {
                    $taskController->getOverdueTasks($userId);
                } 
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'archives':
                if (!empty($userId)) {
                    $taskController->getArchivedTasks($userId);
                } 
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'addTask':
                if (!empty($userId)) {
                    if (isset($_POST['important'])) { $important = $_POST['important']; } else { $important = 0; };
                    if (isset($_POST['time'])) { $time = $_POST['time']; } else { $time = false; };
                    if (isset($_POST['reccuring'])) { $reccuring = $_POST['reccuring']; } else { $reccuring = 0; };
                    $taskController->addTask($_POST['task'], $userId, $important, $time, $_POST['deadline'], $reccuring, $_POST['schedule_number'], $_POST['schedule_delay']);
                }
                else {
                    require('views/frontend/connectView.php'); 
                }
            break;

            case 'editTask':
                if (!empty($userId)) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (isset($_POST['important'])) { $important = $_POST['important']; } else { $important = 0; };
                        if (isset($_POST['time'])) { $time = $_POST['time']; } else { $time = false; };
                        if (isset($_POST['reccuring'])) { $reccuring = $_POST['reccuring']; } else { $reccuring = 0; };
                        $taskController->editTask($_GET['id'], $_POST['task'], $userId, $important, $time, $_POST['deadline'], $reccuring, $_POST['schedule_number'], $_POST['schedule_delay']);
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
                if (!empty($userId)) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $taskController->deleteTask($_GET['id'], $userId);
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