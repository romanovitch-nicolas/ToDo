<?php
namespace ToDo\Controllers;

use ToDo\Models\ListManager;
use ToDo\Models\TaskManager;

class TaskController
{  
    // Affichage du dashboard (tâches en retard, tâches du jour, tâches importantes) d'un utilisateur
    public function getDashboard($userId)
    {
        $taskManager = new TaskManager();
        $listManager = new ListManager();

        $overdueTasks = $taskManager->getOverdueTasks($userId);
        $todayTasks = $taskManager->getTodayTasks($userId);
        $importantTasks = $taskManager->getImportantTasks($userId);
        $lists = $listManager->getLists($userId);

        $todayDate = new \DateTime();
        $todayDate = $todayDate->format('w j n');
        $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

        require('views/backend/dashboardView.php');
    }

	// Affichage de toutes les tâches non terminées d'un utilisateur
    public function getAllUnfinishedTasks($userId)
    {
        $taskManager = new TaskManager();
        $listManager = new ListManager();

        $tasks = $taskManager->getAllUnfinishedTasks($userId);
        $lists = $listManager->getLists($userId);

        $todayDate = new \DateTime();
        $todayDate = $todayDate->format('w j n');
        $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

        require('views/backend/allTasksView.php');
    }

    // Affichage des tâches importantes d'un utilisateur
    public function getImportantTasks($userId)
    {
        $taskManager = new TaskManager();
        $listManager = new ListManager();

        $tasks = $taskManager->getImportantTasks($userId);
        $lists = $listManager->getLists($userId);

        $todayDate = new \DateTime();
        $todayDate = $todayDate->format('w j n');
        $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

        require('views/backend/importantView.php');
    }

    // Affichage des tâches du jour d'un utilisateur
    public function getTodayTasks($userId)
    {
        $taskManager = new TaskManager();
        $listManager = new ListManager();

        $tasks = $taskManager->getTodayTasks($userId);
        $lists = $listManager->getLists($userId);

        $todayDate = new \DateTime();
        $todayDate = $todayDate->format('w j n');
        $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

        require('views/backend/todayView.php');
    }

    // Affichage des tâches des 7 prochains jours d'un utilisateur
    public function getWeekTasks($userId)
    {
        $taskManager = new TaskManager();
        $listManager = new ListManager();

        for($i = 1; $i < 8; ++$i) {
            $days[$i] = $taskManager->getDateDiffTasks($userId, $i);
            $date[$i] = new \DateTime();
            $date[$i] = $date[$i]->modify("+" . $i . "day");
            $date[$i] = $date[$i]->format('w j n');
            $dateNum[$i] = new \DateTime();
            $dateNum[$i] = $dateNum[$i]->modify("+" . $i . "day");
            $dateNum[$i] = $dateNum[$i]->format('Y-m-d');
        }
        $lists = $listManager->getLists($userId);

        $todayDate = new \DateTime();
        $todayDate = $todayDate->format('w j n');
        $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

        require('views/backend/weekView.php');
    }

    // Affichage des tâches en retard d'un utilisateur
    public function getOverdueTasks($userId)
    {
        $taskManager = new TaskManager();
        $listManager = new ListManager();

        $tasks = $taskManager->getOverdueTasks($userId);
        $lists = $listManager->getLists($userId);

        $todayDate = new \DateTime();
        $todayDate = $todayDate->format('w j n');
        $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

        require('views/backend/overdueView.php');
    }

    // Affichage des tâches archivées d'un utilisateur
    public function getArchivedTasks($userId)
    {
        $taskManager = new TaskManager();
        $listManager = new ListManager();

        $tasks = $taskManager->getArchivedTasks($userId);
        $lists = $listManager->getLists($userId);

        $todayDate = new \DateTime();
        $todayDate = $todayDate->format('w j n');
        $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

        require('views/backend/archivesView.php');
    }

	// Ajout d'une tâche
    public function addTask($name, $userId, $important, $time, $deadline, $reccuring, $scheduleNumber, $scheduleDelay, $list, $listId)
    {
        $taskManager = new TaskManager();
        $listManager = new ListManager();

        $name = htmlspecialchars($name);
        $nameLength = strlen($name);
        if ($important == true) { $important = 1; }
        if ($reccuring == true) { $reccuring = 1; }
        if ($scheduleNumber > 0 AND $scheduleNumber <= 999 AND $scheduleDelay === 'day' OR $scheduleDelay === 'week' OR $scheduleDelay === 'month' OR $scheduleDelay === 'year') { 
            $schedule = '+' . $scheduleNumber . ' ' . $scheduleDelay;
        } else {
            $reccuring = 0;
            $schedule = NULL;
        }

        if($nameLength > 0 AND $nameLength <= 255) {
            $insertTask = $taskManager->insertTask($name, $userId, $important, $reccuring);
            if ($insertTask === false) {
                throw new \Exception('Impossible d\'ajouter la tâche.');
            }
            else {
                if ($list == true) {             
                    if (is_int($listId) OR $listId == null) {
                        if ($listId == 0) {
                            $listName = htmlspecialchars($_POST["new_list"]);
                            $listNameLength = strlen($listName);
                            $listDescription = "";
                            if($listNameLength > 0 AND $listNameLength <= 255) {
                                $insertList = $listManager->insertList($userId, $listName, $listDescription);
                                $setList = $taskManager->setList($insertTask, $userId, $insertList);
                                
                            }
                        }
                        else {
                            $setList = $taskManager->setList($insertTask, $userId, $listId);
                        }
                    }
                    else {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
                    if ($setList === false) {
                        throw new \Exception('Impossible d\'associer à la liste.');
                    }
                }
                if ($time == true) {
                    if (preg_match("#(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))#", $deadline)) {
                        $setDeadline = $taskManager->setDeadline($insertTask, $userId, $deadline);
                    }
                    else {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
                }
                else {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
                if ($setDeadline === false) {
                    throw new \Exception('Impossible d\'ajouter l\'échéance.');
                }
                else {
                    if ($reccuring == 1) {
                        $setReccuring = $taskManager->setReccuring($insertTask, $userId, $schedule);
                    }
                    else {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
                    if ($setReccuring === false) {
                        throw new \Exception('Impossible d\'ajouter la récurrence.');
                    }
                    else {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
                }
            }
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // Modification d'une tâche
    public function editTask($id, $name, $userId, $important, $time, $deadline, $reccuring, $scheduleNumber, $scheduleDelay, $list, $listId)
    {
        $taskManager = new TaskManager();

        $name = htmlspecialchars($name);
        $nameLength = strlen($name);
        if ($important == true) { $important = 1; }
        if ($reccuring == true) { $reccuring = 1; }
        if ($scheduleNumber > 0 AND $scheduleNumber <= 999 AND $scheduleDelay === 'day' OR $scheduleDelay === 'week' OR $scheduleDelay === 'month' OR $scheduleDelay === 'year') { 
            $schedule = '+' . $scheduleNumber . ' ' . $scheduleDelay;
        } else {
            $reccuring = 0;
            $schedule = null;
        }

        if($nameLength > 0 AND $nameLength <= 255) {
            $editTask = $taskManager->editTask($id, $name, $userId, $important, $reccuring);
            if ($editTask === false) {
                throw new \Exception('Impossible de modifier la tâche.');
            }
            else {
                if ($list == true) {
                    if (is_int($listId) OR $listId == null) {
                        $setList = $taskManager->setList($id, $userId, $listId);
                    }
                    else {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
                    if ($setList === false) {
                        throw new \Exception('Impossible de modifier la liste.');
                    }
                }
                else {
                    $setList = $taskManager->setList($id, $userId, null);
                    if ($setList === false) {
                        throw new \Exception('Impossible de modifier la liste.');
                    }
                }
                if ($time == true) {
                    if (preg_match("#(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))#", $deadline)) {
                        $setDeadline = $taskManager->setDeadline($id, $userId, $deadline);
                    }
                    else {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
                }
                else {
                    $setDeadline = $taskManager->setDeadline($id, $userId, null);
                }
                if ($setDeadline === false) {
                    throw new \Exception('Impossible de modifier l\'échéance.');
                }
                else {
                    if ($reccuring == 1) {
                        $setReccuring = $taskManager->setReccuring($id, $userId, $schedule);
                    }
                    else {
                        $setReccuring = $taskManager->setReccuring($id, $userId, null);
                    }
                    if ($setReccuring === false) {
                        throw new \Exception('Impossible de modifier la récurrence.');
                    }
                    else {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
                }
            }
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // Suppression d'une tâche
    public function deleteTask($taskId, $userId)
    {
        $taskManager = new TaskManager();

        if(!isset($_GET['reccuring'])) {
        $task = $taskManager->getTask($taskId, $userId);
            if ($task['reccuring'] == 1) {
                $deadline = new \DateTime($task['deadline_date']);
                $deadline = $deadline->modify($task['schedule']);
                $deadline = $deadline->format('Y-m-d');
                $insertReccuringTask = $taskManager->insertReccuringTask($userId, $task['name'], $deadline, $task['important'], $task['schedule']);
                if ($insertReccuringTask === false) {
                    throw new \Exception('Impossible d\'ajouter la tâche récurrente.');
                }
            }
        }

        $deleteTask = $taskManager->deleteTask($taskId, $userId);
        if ($deleteTask === false) {
            throw new \Exception('Impossible de supprimer cette tâche.');
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }    
    }

    // Recherche d'un tâche
    public function search($userId)
    {
        $taskManager = new TaskManager();
        $listManager = new ListManager();

        if(!empty($_POST['search'])) {
            $_SESSION['search'] = htmlspecialchars($_POST['search']);
        }
        $search = $_SESSION['search'];
        if($search !== null) {
            $searchArray = explode(' ', $search);
            foreach ($searchArray as $value) {
                $tasks = $taskManager->searchTasks($value, $userId);
                $achievedTasks = $taskManager->searchAchievedTasks($value, $userId);
            }
            $lists = $listManager->getLists($userId);

            $todayDate = new \DateTime();
            $todayDate = $todayDate->format('w j n');
            $nbTasks = $taskManager->getNumberOfTasks($userId);
            $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
            $nbTodayTasks = $taskManager->getNumberOfToday($userId);
            $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
            $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
            $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);
        }
        else {
            header('Location: ' . LINK_DASHBOARD);
        }
        require('views/backend/searchView.php');
    }
}