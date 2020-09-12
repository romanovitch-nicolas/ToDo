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
                if (!empty($userId)) {
                    $userController->disconnection();
                }
                else {
                    require('views/frontend/homeView.php');
                }
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
                    $taskController->getAllUnfinishedTasks($userId);
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

            case 'lists':
                if (!empty($userId)) {
                    $listController->getLists($userId);
                } 
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'options':
                if (!empty($userId)) {
                    $userController->options($userId);
                }
                else {
                    require('views/frontend/connectView.php');
                }
            break;

            case 'changePass':
                if (!empty($userId)) {
                    $userController->changePass($userId);
                }
                else {
                    require('views/frontend/homeView.php');
                }
            break;

            case 'addTask':
                if (!empty($userId)) {
                    if (isset($_POST['important'])) { $important = $_POST['important']; } else { $important = 0; };
                    if (isset($_POST['time'])) { $time = $_POST['time']; } else { $time = false; };
                    if (isset($_POST['deadline'])) { $deadline = $_POST['deadline']; } else { $deadline = null; };
                    if (isset($_POST['reccuring'])) { $reccuring = $_POST['reccuring']; } else { $reccuring = 0; };           
                    if (isset($_POST['schedule_number'])) { $scheduleNumber = $_POST['schedule_number']; } else { $scheduleNumber = null; };
                    if (isset($_POST['schedule_delay'])) { $scheduleDelay = $_POST['schedule_delay']; } else { $scheduleDelay = null; };
                    if (isset($_POST['list'])) { $list = $_POST['list']; } else { $list = 0; };
                    if (isset($_POST['list_select']) AND !empty($_POST['list_select'])) { $listSelect = intval($_POST['list_select']); } else { $listSelect = null; };
                    $taskController->addTask($_POST['task'], $userId, $important, $time, $deadline, $reccuring, $scheduleNumber, $scheduleDelay, $list, $listSelect);
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
                        if (isset($_POST['deadline'])) { $deadline = $_POST['deadline']; } else { $deadline = null; };
                        if (isset($_POST['reccuring'])) { $reccuring = $_POST['reccuring']; } else { $reccuring = 0; };
                        if (isset($_POST['schedule_number'])) { $scheduleNumber = $_POST['schedule_number']; } else { $scheduleNumber = null; };
                        if (isset($_POST['schedule_delay'])) { $scheduleDelay = $_POST['schedule_delay']; } else { $scheduleDelay = null; };
                        if (isset($_POST['list'])) { $list = $_POST['list']; } else { $list = 0; };
                        if (isset($_POST['list_select']) AND !empty($_POST['list_select'])) { $listSelect = intval($_POST['list_select']); } else { $listSelect = null; };
                        $taskController->editTask($_GET['id'], $_POST['task'], $userId, $important, $time, $deadline, $reccuring, $scheduleNumber, $scheduleDelay, $list, $listSelect);
                    }
                    else
                    {
                        $taskController->getDashboard($userId);
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
                        $taskController->getDashboard($userId);
                    }
                }
                else {
                    require('views/frontend/connectView.php'); 
                }
            break;

            case 'addList':
                if (!empty($userId)) {
                    $listController->addList($userId, $_POST['name'], $_POST['description']);
                }
                else {
                    require('views/frontend/connectView.php'); 
                }
            break;

            case 'editList':
                if (!empty($userId)) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $listController->editList($_GET['id'], $userId, $_POST['name'], $_POST['description']);
                    }
                    else
                    {
                        $taskController->getDashboard($userId);
                    }
                }
                else {
                    require('views/frontend/connectView.php'); 
                }
            break;

            case 'deleteList':
                if (!empty($userId)) {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (isset($_GET['tasks']) && $_GET['tasks'] == true) {
                            $listController->deleteListAndTasks($_GET['id'], $userId);
                        }
                        else {
                            $listController->deleteList($_GET['id'], $userId);
                        }
                    }
                    else
                    {
                        $taskController->getDashboard($userId);
                    }
                }
                else {
                    require('views/frontend/connectView.php'); 
                }
            break;

            case 'search':
                if (!empty($userId)) {
                    $taskController->search($userId);
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