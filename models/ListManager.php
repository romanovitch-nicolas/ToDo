<?php
namespace ToDo\Models;

require_once("Manager.php");

class ListManager extends Manager
{
	// Connexion à la base de données lors de l'instanciation
    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    // Récupération des listes d'un utilisateur
    public function getLists($userId)
    {
        $req = $this->db->prepare('
        	SELECT id, user_id, name, description, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr
        	FROM lists
        	WHERE user_id = ?
        	ORDER BY creation_date'
        );
        $req->execute(array($userId));

        $lists = [];
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $lists[] = new ListEntity($data);
        }

        return $lists;
    }

    // Ajout d'une liste
    public function insertList($userId, $name, $description)
    {
    	$req = $this->db->prepare('INSERT INTO lists(user_id, name, description, creation_date) VALUES(?, ?, ?, NOW())');
        $insertList = $req->execute(array($userId, $name, $description));
        $lastId = $this->db->lastInsertId();

        return $lastId;
    }

    // Edition d'une liste
    public function editList($id, $userId, $name, $description)
    {
        $req = $this->db->prepare('UPDATE lists SET name = ?, description = ? WHERE id = ? AND user_id = ?');
        $editList = $req->execute(array($name, $description, $id, $userId));

        return $editList;
    }

    // Suppression d'une liste
    public function deleteList($listId, $userId)
    {
        $req = $this->db->prepare('DELETE FROM lists WHERE id = ? AND user_id = ?');
        $deleteList = $req->execute(array($listId, $userId));

        return $deleteList;
    }
}