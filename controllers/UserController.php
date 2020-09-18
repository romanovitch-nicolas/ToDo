<?php
namespace ToDo\Controllers;

use ToDo\Models\TaskManager;
use ToDo\Models\UserManager;

class UserController
{   
	// Inscription
	public function inscription()
    {
		$userManager = new UserManager();

		// Empêchement des injections de code
		if (!empty($_POST["login"]) AND !empty($_POST["pass"]) AND !empty($_POST["pass_confirm"]) AND !empty($_POST["mail"])) {	
			$login = htmlspecialchars($_POST["login"]);
	        $pass = htmlspecialchars($_POST["pass"]);
	        $passConfirm = htmlspecialchars($_POST["pass_confirm"]);
	        $mail = htmlspecialchars($_POST["mail"]);

	        $loginLength = strlen($login);
	        $passLength = strlen($pass);
	        $passConfirmLength = strlen($passConfirm);
	        $mailLength = strlen($mail);

	        // Vérifications du formulaire
			if ($loginLength <= 255) {
				if ($passLength <= 255) {
					if ($mailLength <= 255) {
						if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)) {
							if ($passConfirmLength <= 255 AND $pass === $passConfirm) {
								$loginCheck = $userManager->checkLoginAvailability($login);
								if ($loginCheck === true) {

									// Hachage du mot de passe
									$passHash = password_hash($pass, PASSWORD_DEFAULT);
									// Insertion dans la BDD
									$insertUser = $userManager->insertUser($login, $passHash, $mail);

									if ($insertUser === false) {
										throw new \Exception('Impossible de finaliser l\'inscription.');
									}
									else {
										$return = true;
									}
								}
								else {
									$return = 'Cet identifiant est déjà pris.';
								}
							}
							else {
								$return = 'Les mots de passe ne correspondent pas.';
							}
						}
						else {
							$return = 'L\'adresse mail n\'est pas valide.';
						}
					}
					else {
						$return = 'L\'adresse mail ne doit pas dépasser 255 caractères.';
					}
				}
				else {
					$return = 'Le mot de passe ne doit pas dépasser 255 caractères.';
				}
			}
			else {
				$return = 'L\'identifiant ne doit pas dépasser 255 caractères.';
			}
		}
		else {
	        $return = 'Tous les champs ne sont pas remplis.';
	    }

	    require('views/frontend/inscriptionView.php');
	}

	// Connexion
	public function connection()
	{
		$userManager = new UserManager();

		if (!empty($_POST["login"]) AND !empty($_POST["pass"])) {
            $login = htmlspecialchars($_POST["login"]);
            $pass = htmlspecialchars($_POST["pass"]);
            $userinfo = $userManager->getUserInfoByLogin($login);
            $passverif = password_verify($pass, $userinfo->pass());
            if ($passverif) {
            	session_start();
                $_SESSION['id'] = $userinfo->id();
                    if(isset($_POST['autoconnect']))
                    {
                    	setcookie('id', $userinfo->id(), time() + 365*24*3600, null, null, false, true);
                    }
                header('Location: ' . LINK_DASHBOARD);
            }
            else {
                $return = 'Mauvais identifiant ou mot de passe.';
            }
        }
        else {
            $return = 'Tous les champs ne sont pas remplis.';
        }

        require('views/frontend/connectView.php');
	}

	// Déconnexion
    public function disconnection()
    { 
        $_SESSION = array();
        session_destroy();
        setcookie('id', '');
        header("Location: " . LINK_HOME);
    }

    // Options
    public function options($userId)
    {
    	$taskManager = new TaskManager();

    	$todayDate = new \DateTime();
        $todayDate = $todayDate->format('w j n');
    	$nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

    	require('views/backend/optionsView.php');
    }

    // Changement de mot de passe
	public function changePass($userId)
    {
    	$taskManager = new TaskManager();
		$userManager = new UserManager();

		// Empêchement des injections de code
		if (!empty($_POST["old_pass"]) AND !empty($_POST["new_pass"]) AND !empty($_POST["pass_confirm"])) {	
	        $oldPass = htmlspecialchars($_POST["old_pass"]);
	        $newPass = htmlspecialchars($_POST["new_pass"]);
	        $passConfirm = htmlspecialchars($_POST["pass_confirm"]);

	        $oldPassLength = strlen($oldPass);
	        $newPassLength = strlen($newPass);
	        $passConfirmLength = strlen($passConfirm);

	        // Vérifications du formulaire
			if ($oldPassLength <= 255) {
				if ($newPassLength <= 255) {
					if ($passConfirmLength <= 255 AND $newPass === $passConfirm) {
						$userInfo = $userManager->getUserInfoById($userId);
						$passVerif = password_verify($oldPass, $userInfo->pass());
						if ($passVerif === true) {

							// Hachage du mot de passe
							$passHash = password_hash($newPass, PASSWORD_DEFAULT);
							// Modification du mot de passe dans la BDD
							$setPass = $userManager->setPass($userId, $passHash);

							if ($setPass === false) {
								throw new \Exception('Impossible de modifier le mot de passe.');
							}
							else {
								$return = true;
							}
						}
						else {
							$return = 'Mauvais mot de passe.';
						}
					}
					else {
						$return = 'Les mots de passe ne correspondent pas.';
					}
				}
				else {
					$return = 'Le mot de passe ne doit pas dépasser 255 caractères.';
				}
			}
			else {
				$return = 'Le mot de passe ne doit pas dépasser 255 caractères.';
			}
		}
		else {
	        $return = 'Tous les champs ne sont pas remplis.';
	    }

	    $todayDate = new \DateTime();
        $todayDate = $todayDate->format('w j n');
	    $nbTasks = $taskManager->getNumberOfTasks($userId);
        $nbImportantTasks = $taskManager->getNumberOfImportant($userId);
        $nbTodayTasks = $taskManager->getNumberOfToday($userId);
        $nbWeekTasks = $taskManager->getNumberOfWeek($userId);
        $nbOverdueTasks = $taskManager->getNumberOfOverdue($userId);
        $nbArchivedTasks = $taskManager->getNumberOfArchived($userId);

	    require('views/backend/optionsView.php');
	}
}