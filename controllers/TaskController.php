<?php
namespace ToDo\Controllers;

use ToDo\Models\ListManager;
use ToDo\Models\TaskManager;

class TaskController
{   
	// Affichage de toutes les tâches d'un utilisateur
    public function getAllTasks($userId)
    {
        $taskManager = new TaskManager();

        $tasks = $taskManager->getAllTasks($userId);

        require('views/backend/allTasksView.php');
    }

	// Ajout d'une tâche
    public function addTask($name, $userId, $important)
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
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    // Modification d'une tâche
    public function editTask($id, $name, $userId, $important)
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
                header('Location: ' . $_SERVER['HTTP_REFERER']);
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