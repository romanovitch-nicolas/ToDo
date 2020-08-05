<?php
namespace ToDo\Controllers;

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
	public function connexion()
	{
		$userManager = new UserManager();

		if (!empty($_POST["login"]) AND !empty($_POST["pass"])) {
            $login = htmlspecialchars($_POST["login"]);
            $pass = htmlspecialchars($_POST["pass"]);
            $userinfo = $userManager->getUserInfo($login);
            $passverif = password_verify($pass, $userinfo->pass());
            if ($passverif) {
            	session_start();
                $_SESSION['id'] = $userinfo->id();
                $_SESSION['login'] = $login;
                    if(isset($_POST['autoconnect']))
                    {
                    	setcookie('id', $userinfo->id(), time() + 365*24*3600, null, null, false, true);
                        setcookie('login', $login, time() + 365*24*3600, null, null, false, true);
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
}