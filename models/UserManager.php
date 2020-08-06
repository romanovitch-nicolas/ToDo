<?php
namespace ToDo\Models;
require_once("Manager.php");

class UserManager extends Manager
{

	public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    // Vérifie si un pseudo est déjà pris
	public function checkLoginAvailability($login) {
		$req = $this->db->prepare('SELECT login FROM users WHERE login = ?');
        $req->execute(array($login));
        $check = $req->rowCount();
        if ($check == 0) {
        	return true;
        }
        else {
        	return false;
        }
	}

	// Ajoute un utlisateur à la base de données
	public function insertUser($login, $pass, $mail)
    {
        $req = $this->db->prepare('INSERT INTO users(login, pass, mail, inscription_date) VALUES(?, ?, ?, NOW())');
        $insertUser = $req->execute(array($login, $pass, $mail));

        return $insertUser;
    }

    // Récupération des informations d'un utilisateur depuis son login
    public function getUserInfo($login)
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE login = ?');
        $req->execute(array($login));
        $userinfo = $req->fetch(\PDO::FETCH_ASSOC);

        return new User($userinfo);
    }
}