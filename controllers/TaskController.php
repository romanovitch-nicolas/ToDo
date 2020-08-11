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

        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);

        require('views/backend/dashboardView.php');
    }

	// Affichage de toutes les tâches d'un utilisateur
    public function getAllTasks($userId)
    {
        $taskManager = new TaskManager();

        $tasks = $taskManager->getAllTasks($userId);

        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);

        require('views/backend/allTasksView.php');
    }

    // Affichage des tâches importantes d'un utilisateur
    public function getImportantTasks($userId)
    {
        $taskManager = new TaskManager();

        $tasks = $taskManager->getImportantTasks($userId);

        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);

        require('views/backend/importantView.php');
    }

    // Affichage des tâches du jour d'un utilisateur
    public function getTodayTasks($userId)
    {
        $taskManager = new TaskManager();

        $tasks = $taskManager->getTodayTasks($userId);

        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);

        require('views/backend/todayView.php');
    }

    // Affichage des tâches des 7 prochains jours d'un utilisateur
    public function getWeekTasks($userId)
    {
        $taskManager = new TaskManager();

        $tasks = $taskManager->getWeekTasks($userId);

        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);

        require('views/backend/weekView.php');
    }

    // Affichage des tâches en retard d'un utilisateur
    public function getOverdueTasks($userId)
    {
        $taskManager = new TaskManager();

        $tasks = $taskManager->getOverdueTasks($userId);

        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);

        require('views/backend/overdueView.php');
    }

    // Affichage des tâches archivées d'un utilisateur
    public function getArchivedTasks($userId)
    {
        $taskManager = new TaskManager();

        $tasks = $taskManager->getArchivedTasks($userId);

        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);

        require('views/backend/archivesView.php');
    }

	// Ajout d'une tâche
    public function addTask($name, $userId, $important, $time, $deadline)
    {
        $taskManager = new TaskManager();

        $name = htmlspecialchars($name);
        $nameLength = strlen($name);
        if ($important == true) {
            $important = 1;
        }
        else {
            $important = 0;
        }

        if($nameLength <= 255) {
            $insertTask = $taskManager->insertTask($name, $userId, $important);
            if ($insertTask === false) {
                throw new \Exception('Impossible d\'ajouter la tâche.');
            }
            else {
                if ($time == true) {
                    $setDeadline = $taskManager->setDeadline($insertTask, $userId, $deadline);
                }
                else {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
                if ($setDeadline === false) {
                    throw new \Exception('Impossible d\'ajouter l\'échéance.');
                }
                else {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // Modification d'une tâche
    public function editTask($id, $name, $userId, $important, $time, $deadline)
    {
        $taskManager = new TaskManager();

        $name = htmlspecialchars($name);
        $nameLength = strlen($name);
        if ($important == true) {
            $important = 1;
        }
        else {
            $important = 0;
        }

        if($nameLength <= 255) {
            $editTask = $taskManager->editTask($id, $name, $userId, $important);
            if ($editTask === false) {
                throw new \Exception('Impossible de modifier la tâche.');
            }
            else {
                if ($time == true) {
                    $setDeadline = $taskManager->setDeadline($id, $userId, $deadline);
                }
                else {
                    $setDeadline = $taskManager->setDeadline($id, $userId, null);
                }
                if ($setDeadline === false) {
                    throw new \Exception('Impossible d\'ajouter l\'échéance.');
                }
                else {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
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

        $deleteTask = $taskManager->deleteTask($taskId, $userId);

        if ($deleteTask === false) {
            throw new \Exception('Impossible de supprimer cette tâche.');
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }    
    }
}