<?php
namespace ToDo\Models;

require_once("../models/Manager.php");

class ajaxCheckbox extends Manager
{
    public function __construct()
    {
    	// Connexion à la base de données lors de l'instanciation
        $this->db = $this->dbConnect();

        if (isset($_SESSION['id'])) {
        	$userId = $_SESSION['id'];
        }
        elseif (isset($_COOKIE['id'])) {
        	$userId = $_COOKIE['id'];
        }

        // Récupération d'une tâche
	    $req = $this->db->prepare('
        	SELECT id, user_id, list_id, name, deadline_date, completion_date, important, done, reccuring, schedule
        	FROM tasks
        	WHERE id = ? AND user_id = ?
        	ORDER BY creation_date'
        );
		$req->execute(array($_POST['task_id'], $userId));

        $task = $req->fetch(\PDO::FETCH_ASSOC);

        // Validation des checkbox en BDD
        if($_POST['done'] == 1) {
        	$req = $this->db->prepare('UPDATE tasks SET done = ?, completion_date = NOW() WHERE id = ? AND user_id = ?');
			$req->execute(array($_POST['done'], $_POST['task_id'], $userId));

        	// Vérification de la récurrence de la tâche
		    if($task['reccuring'] == 1) {
		    	$date = new \DateTime($task['deadline_date']);
		    	$date = $date->modify($task['schedule']);
		    	$date = $date->format('Y-m-d');
		        $req = $this->db->prepare('INSERT INTO tasks(name, user_id, list_id, creation_date, deadline_date, completion_date, important, done, reccuring, schedule) VALUES(?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?)');
				$req->execute(array($task['name'], $userId, $task['list_id'], $date, NULL, $task['important'], 0, $task['reccuring'], $task['schedule']));
			}
		}
		else {
			// Suppression des éventuelles futures tâches récurrentes
			if($task['reccuring'] == 1) {
				$req = $this->db->prepare('SELECT completion_date FROM tasks WHERE id = ? AND user_id = ?');
				$req->execute(array($_POST['task_id'], $userId));

				$reccuringTask = $req->fetch(\PDO::FETCH_ASSOC);

				$req = $this->db->prepare('DELETE FROM tasks WHERE user_id = ? AND name = ? AND creation_date = ?');
				var_dump($reccuringTask['completion_date']);
				$deleteProduct = $req->execute(array($task['user_id'], $task['name'], $reccuringTask['completion_date']));
			}

			$req = $this->db->prepare('UPDATE tasks SET done = ?, completion_date = ? WHERE id = ? AND user_id = ?');
			$req->execute(array($_POST['done'], NULL, $_POST['task_id'], $userId));
		}
    }
}

new ajaxCheckbox();