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

        $overdueTasks = $taskManager->getOverdueTasks($userId);
        $todayTasks = $taskManager->getTodayTasks($userId);
        $importantTasks = $taskManager->getImportantTasks($userId);

        $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

        require('views/backend/dashboardView.php');
    }

	// Affichage de toutes les tâches d'un utilisateur
    public function getAllTasks($userId)
    {
        $taskManager = new TaskManager();

        $tasks = $taskManager->getAllTasks($userId);

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

        $tasks = $taskManager->getImportantTasks($userId);

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

        $tasks = $taskManager->getTodayTasks($userId);

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

        $tasks = $taskManager->getWeekTasks($userId);

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

        $tasks = $taskManager->getOverdueTasks($userId);

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

        $tasks = $taskManager->getArchivedTasks($userId);

        $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

        require('views/backend/archivesView.php');
    }

	// Ajout d'une tâche
    public function addTask($name, $userId, $important, $time, $deadline, $reccuring, $scheduleNumber, $scheduleDelay)
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
            $schedule = NULL;
        }

        if($nameLength <= 255) {
            $insertTask = $taskManager->insertTask($name, $userId, $important, $reccuring);
            if ($insertTask === false) {
                throw new \Exception('Impossible d\'ajouter la tâche.');
            }
            else {
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
    public function editTask($id, $name, $userId, $important, $time, $deadline, $reccuring, $scheduleNumber, $scheduleDelay)
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

        if($nameLength <= 255) {
            $editTask = $taskManager->editTask($id, $name, $userId, $important, $reccuring);
            if ($editTask === false) {
                throw new \Exception('Impossible de modifier la tâche.');
            }
            else {
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

        $deleteTask = $taskManager->deleteTask($taskId, $userId);
        if ($deleteTask === false) {
            throw new \Exception('Impossible de supprimer cette tâche.');
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }    
    }
}