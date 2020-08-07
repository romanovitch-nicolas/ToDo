<?php
namespace ToDo\Models;

require_once("../models/Manager.php");

class ajaxCheckbox extends Manager
{
	// Connexion à la base de données lors de l'instanciation
    public function __construct()
    {
        $this->db = $this->dbConnect();
        $req = $this->db->prepare('UPDATE tasks SET done = ? WHERE id = ? AND user_id = ?');
        if (isset($_SESSION['id'])) {
			$req->execute(array($_POST['done'], $_POST['task_id'], $_SESSION['id']));
		}
		elseif (isset($_COOKIE['id'])) {
			$req->execute(array($_POST['done'], $_POST['task_id'], $_COOKIE['id']));
		}
    }
}

new ajaxCheckbox();