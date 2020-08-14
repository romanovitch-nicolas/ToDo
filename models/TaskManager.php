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

    // Récupération du nombre de tâches d'un utilisateur
    public function getNumberOfTasks($userId)
    {
        $req = $this->db->prepare('SELECT id FROM tasks WHERE user_id = ? AND done = 0');
        $req->execute(array($userId));
        $nbTasks = $req->rowCount();

        return $nbTasks;
    }

    // Récupération du nombre de tâches importantes d'un utilisateur
    public function getNumberOfImportant($userId)
    {
        $req = $this->db->prepare('SELECT id FROM tasks WHERE user_id = ? AND done = 0 AND important = 1');
        $req->execute(array($userId));
        $nbTasks = $req->rowCount();

        return $nbTasks;
    }

    // Récupération du nombre de tâches du jour d'un utilisateur
    public function getNumberOfToday($userId)
    {
        $req = $this->db->prepare('SELECT id FROM tasks WHERE user_id = ? AND done = 0 AND DATEDIFF(deadline_date, NOW()) = 0');
        $req->execute(array($userId));
        $nbTasks = $req->rowCount();

        return $nbTasks;
    }

    // Récupération du nombre de tâches de la semaine d'un utilisateur
    public function getNumberOfWeek($userId)
    {
        $req = $this->db->prepare('SELECT id FROM tasks WHERE user_id = ? AND done = 0 AND DATEDIFF(deadline_date, NOW()) >= 0 AND DATEDIFF(deadline_date, NOW()) <= 7');
        $req->execute(array($userId));
        $nbTasks = $req->rowCount();

        return $nbTasks;
    }

    // Récupération du nombre de tâches en retard d'un utilisateur
    public function getNumberOfOverdue($userId)
    {
        $req = $this->db->prepare('SELECT id FROM tasks WHERE user_id = ? AND done = 0 AND DATEDIFF(deadline_date, NOW()) < 0');
        $req->execute(array($userId));
        $nbTasks = $req->rowCount();

        return $nbTasks;
    }

    // Récupération du nombre de tâches effectuées les 30 derniers jours d'un utilisateur
    public function getNumberOfArchived($userId)
    {
        $req = $this->db->prepare('SELECT id FROM tasks WHERE user_id = ? AND done = 1 AND DATEDIFF(completion_date, NOW()) <= 0 AND DATEDIFF(completion_date, NOW()) >= "-30"');
        $req->execute(array($userId));
        $nbTasks = $req->rowCount();

        return $nbTasks;
    }

    // Récupération d'une tâche d'un utilisateur
    public function getTask($id, $userId)
    {
        $req = $this->db->prepare('
            SELECT id, user_id, list_id, name, creation_date, deadline_date, completion_date, important, done, reccuring, schedule
            FROM tasks
            WHERE id = ? AND user_id = ?'
        );
        $req->execute(array($id, $userId));
        $task = $req->fetch();

        return $task;
    }

    // Récupération de toutes les tâches d'un utilisateur
    public function getAllTasks($userId)
    {
        $req = $this->db->prepare('
        	SELECT id, user_id, list_id, name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(deadline_date, \'%d/%m/%Y\') AS deadline_date_fr, important, done, reccuring, schedule
        	FROM tasks
        	WHERE user_id = ? AND done = 0
        	ORDER BY creation_date'
        );
        $req->execute(array($userId));

        $tasks = [];
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $tasks[] = new Task($data);
        }

        return $tasks;
    }

    // Récupération des tâches importantes d'un utilisateur
    public function getImportantTasks($userId)
    {
        $req = $this->db->prepare('
            SELECT id, user_id, list_id, name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(deadline_date, \'%d/%m/%Y\') AS deadline_date_fr, important, done, reccuring, schedule
            FROM tasks
            WHERE user_id = ? AND done = 0 AND important = 1
            ORDER BY creation_date'
        );
        $req->execute(array($userId));

        $tasks = [];
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $tasks[] = new Task($data);
        }

        return $tasks;
    }

    // Récupération des tâches du jour d'un utilisateur
    public function getTodayTasks($userId)
    {
        $req = $this->db->prepare('
            SELECT id, user_id, list_id, name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(deadline_date, \'%d/%m/%Y\') AS deadline_date_fr, important, done, reccuring, schedule
            FROM tasks
            WHERE user_id = ? AND DATEDIFF(deadline_date, NOW()) = 0
            ORDER BY creation_date'
        );
        $req->execute(array($userId));

        $tasks = [];
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $tasks[] = new Task($data);
        }

        return $tasks;
    }

    // Récupération des tâches des 7 prochains jours d'un utilisateur
    public function getWeekTasks($userId)
    {
        $req = $this->db->prepare('
            SELECT id, user_id, list_id, name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(deadline_date, \'%d/%m/%Y\') AS deadline_date_fr, important, done, reccuring, schedule
            FROM tasks
            WHERE user_id = ? AND done = 0 AND DATEDIFF(deadline_date, NOW()) >= 0 AND DATEDIFF(deadline_date, NOW()) <= 7
            ORDER BY creation_date'
        );
        $req->execute(array($userId));

        $tasks = [];
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $tasks[] = new Task($data);
        }

        return $tasks;
    }

    // Récupération des tâches en retard d'un utilisateur
    public function getOverdueTasks($userId)
    {
        $req = $this->db->prepare('
            SELECT id, user_id, list_id, name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(deadline_date, \'%d/%m/%Y\') AS deadline_date_fr, important, done, reccuring, schedule
            FROM tasks
            WHERE user_id = ? AND done = 0 AND DATEDIFF(deadline_date, NOW()) < 0
            ORDER BY creation_date'
        );
        $req->execute(array($userId));

        $tasks = [];
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $tasks[] = new Task($data);
        }

        return $tasks;
    }

    // Récupération des tâches archivées d'un utilisateur
    public function getArchivedTasks($userId)
    {
        $req = $this->db->prepare('
            SELECT id, user_id, list_id, name, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(deadline_date, \'%d/%m/%Y\') AS deadline_date_fr, DATE_FORMAT(completion_date, \'%d/%m/%Y\') AS completion_date_fr, important, done, reccuring, schedule
            FROM tasks
            WHERE user_id = ? AND done = 1 AND DATEDIFF(completion_date, NOW()) <= 0 AND DATEDIFF(completion_date, NOW()) >= "-30"
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
    public function insertTask($name, $userId, $important, $reccuring)
    {
        $req = $this->db->prepare('INSERT INTO tasks(name, user_id, list_id, creation_date, deadline_date, important, reccuring) VALUES(?, ?, ?, NOW(), ?, ?, ?)');
        $insertTask = $req->execute(array($name, $userId, NULL, NULL, $important, $reccuring));
        $lastId = $this->db->lastInsertId();

        return $lastId;
    }

    // Ajout d'une tâche récurrente
    public function insertReccuringTask($userId, $name, $deadlineDate, $important, $schedule)
    {
        $req = $this->db->prepare('INSERT INTO tasks(user_id, list_id, name, creation_date, deadline_date, completion_date, important, reccuring, schedule) VALUES(?, ?, ?, NOW(), ?, ?, ?, ?, ?)');
        $insertReccuringTask = $req->execute(array($userId, NULL, $name, $deadlineDate, NULL, $important, 1, $schedule));

        return $insertReccuringTask;
    }

    // Edition d'une tâche
    public function editTask($taskId, $name, $userId, $important, $reccuring)
    {
        $req = $this->db->prepare('UPDATE tasks SET name = ?, important = ?, reccuring = ? WHERE id = ? AND user_id = ?');
        $editTask = $req->execute(array($name, $important, $reccuring, $taskId, $userId));

        return $editTask;
    }

    // Edition d'une date d'échéance
    public function setDeadline($taskId, $userId, $deadline)
    {
        $req = $this->db->prepare('UPDATE tasks SET deadline_date = ? WHERE id = ? AND user_id = ?');
        $setDeadline = $req->execute(array($deadline, $taskId, $userId));

        return $setDeadline;
    }

    // Edition d'une récurrence
    public function setReccuring($taskId, $userId, $schedule)
    {
        $req = $this->db->prepare('UPDATE tasks SET schedule = ? WHERE id = ? AND user_id = ?');
        $setRecurring = $req->execute(array($schedule, $taskId, $userId));

        return $setRecurring;
    }

    // Suppression d'une tâche
    public function deleteTask($taskId, $userId)
    {
        $req = $this->db->prepare('DELETE FROM tasks WHERE id = ? AND user_id = ?');
        $deleteProduct = $req->execute(array($taskId, $userId));

        return $deleteTask;
    }
}