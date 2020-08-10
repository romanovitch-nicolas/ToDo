<?php
namespace ToDo\Models;

require_once("Manager.php");

class TaskManager extends Manager
{
	// Connexion à la base de données lors de l'instanciation
    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    // Récupération de toutes les tâches d'un utilisateur
    public function getAllTasks($userId)
    {
        $req = $this->db->prepare('
        	SELECT id, user_id, list_id, name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(deadline_date, \'%d/%m/%Y\') AS deadline_date_fr, important, done 
        	FROM tasks
        	WHERE user_id = ?
        	ORDER BY creation_date'
        );
        $req->execute(array($userId));

        $tasks = [];
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $tasks[] = new Task($data);
        }

        return $tasks;
    }

    // Ajout d'une tâche
    public function insertTask($name, $userId, $important)
    {
        $req = $this->db->prepare('INSERT INTO tasks(name, user_id, list_id, creation_date, deadline_date, important) VALUES(?, ?, ?, NOW(), ?, ?)');
        $insertTask = $req->execute(array($name, $userId, NULL, NULL, $important));
        $lastId = $this->db->lastInsertId();

        return $lastId;
    }

    // Edition d'une tâche
    public function editTask($taskId, $name, $userId, $important)
    {
        $req = $this->db->prepare('UPDATE tasks SET name = ?, important = ? WHERE id = ? AND user_id = ?');
        $editTask = $req->execute(array($name, $important, $taskId, $userId));

        return $editTask;
    }

    // Suppression d'une tâche
    public function deleteTask($taskId, $userId)
    {
        $req = $this->db->prepare('DELETE FROM tasks WHERE id = ? AND user_id = ?');
        $deleteProduct = $req->execute(array($taskId, $userId));

        return $deleteTask;
    }

    // Ajout d'une date d'échéance
    public function setDeadline($taskId, $userId, $deadline)
    {
        $req = $this->db->prepare('UPDATE tasks SET deadline_date = ? WHERE id = ? AND user_id = ?');
        $setDeadline = $req->execute(array($deadline, $taskId, $userId));

        return $setDeadline;
    }
}