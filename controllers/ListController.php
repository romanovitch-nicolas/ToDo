<?php
namespace ToDo\Controllers;

use ToDo\Models\ListManager;
use ToDo\Models\TaskManager;

class ListController
{   
	// Affichage des listes
    public function getLists($userId)
    {
    	$listManager = new ListManager();
        $taskManager = new TaskManager();

        $lists = $listManager->getLists($userId);
        $tasks = $taskManager->getAllTasks($userId);

        $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

        require('views/backend/listView.php');
    }

    // Ajout d'une liste
    public function addList($userId, $name, $description)
    {
        $listManager = new ListManager();

        $name = htmlspecialchars($name);
        $nameLength = strlen($name);
        $description = htmlspecialchars($description);

        if($nameLength > 0 AND $nameLength <= 255) {
            $insertList = $listManager->insertList($userId, $name, $description);
            if ($insertList === false) {
                throw new \Exception('Impossible d\'ajouter la liste.');
            }
            else {
            	header('Location: ' . $_SERVER['HTTP_REFERER']);
       		}
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // Modification d'une liste
    public function editList($id, $userId, $name, $description)
    {
        $listManager = new ListManager();

        $name = htmlspecialchars($name);
        $nameLength = strlen($name);
        $description = htmlspecialchars($description);

        if($nameLength > 0 AND $nameLength <= 255) {
            $editList = $listManager->editList($id, $userId, $name, $description);
            if ($editList === false) {
                throw new \Exception('Impossible de modifier la liste.');
            }
            else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // Suppression d'une liste
    public function deleteList($listId, $userId)
    {
        $listManager = new ListManager();
        $taskManager = new TaskManager();

        $deleteList = $listManager->deleteList($listId, $userId);
        $setListToNull = $taskManager->setListToNull($listId, $userId);

        if ($deleteList === false) {
            throw new \Exception('Impossible de supprimer cette liste.');
        }
        elseif ($setListToNull === false) {
            throw new \Exception('Impossible de modifier les tâches de la liste.');
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }    
    }

    // Suppression d'une liste et de ses tâches
    public function deleteListAndTasks($listId, $userId)
    {
        $listManager = new ListManager();
        $taskManager = new TaskManager();

        $deleteList = $listManager->deleteList($listId, $userId);
        $deleteTasks = $taskManager->deleteTasksFromList($listId, $userId);

        if ($deleteList === false) {
            throw new \Exception('Impossible de supprimer cette liste.');
        }
        elseif ($deleteTasks === false) {
            throw new \Exception('Impossible de supprimer les tâches de cette liste.');
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }    
    }
}