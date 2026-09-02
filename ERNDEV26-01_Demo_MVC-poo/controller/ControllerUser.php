<?php
//CONTROLLER
//Indication de l'espace de nom possédant la class ControllerUser
namespace Controller;

/*Bonne pratique des namespaces :
- utiliser un namespace identique au nom du dossier
- La première lettre de chaque lettre d'un namespace commence par une Majuscule
=> le nom du dossier doit commencer par une Majuscule
- Le nom du fichier doit être identique au nom de la class, majuscule comprise
*/

use Controller\Controller;

class ControllerUser extends Controller {


    public function seConnecter():void {
        $message="";

        //Verification que le formulaire soit envoyé
        if(isset($_POST["submit"]) ){
            
            //néttoyage
            $email = trim($_POST["email"] ?? '');
            $password = $_POST["password"] ?? '';

            //Vérification que les champs soient remplis
            if(!empty($email) && !empty($password)) {
                if(empty($message)) {
                    $this->getModel()->setEmail($email);
                    $user = $this->getModel()->findByEmail($email);
                    if(!empty($user) && password_verify($password,$user["password"])) {
                        $_SESSION["email"] = $user["email"];
                        $_SESSION["pseudo"] = $user["pseudo"];
                        $_SESSION["id"] = $user["id"];
                        $_SESSION["role_id"] = $user["role_id"];
                        $_SESSION["created_at"]=$user["created_at"];
                        if(empty($user) || !password_verify($password, $user["password"])) {
                        $message ="Les informations de connexion ne sont pas correctes." ;
                    }
                    
                    }else {
                        $message ="Les informations de connexion ne sont pas correctes." ;
                    }
                }
            }else {
                $message="Un des champs n'est pas remplis." ;
            }
            
        }
        $this->getView()->setMessage($message);
        if(empty($message) && isset($_SESSION["pseudo"])) {
            $this->getView()->setMessage("Bienvenue ".$_SESSION["pseudo"]);
        }
    }


    public function registerUser():void {
        $errors=[];
        if(isset($_POST['submitInscription'])) {

                // Vérification CSRF

                // Récupération des données brute, le mot de passe va etre haché plus tard
                $email = trim($_POST["email"] ?? '');
                $pseudo = trim($_POST["pseudo"] ?? '');
                $password = $_POST["password"] ?? '';
                $confirm = $_POST["passwordVerif"] ?? '';

                // Validation des champs
                if(empty($email) || empty($pseudo) || empty($password) || empty($confirm )) {
                    $errors[] = "Un des champs n'est pas remplis.";
                }

                // Validation du format de l'email
                if(!empty($email) && !filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    $errors[] ="L'adresse email n'est pas valide.";
                }

                // Validation de la correspondance des mots de passe
                if($password !== $confirm) {
                    $errors [] = "Les deux mots de passe ne correspondent pas.";
                }

                //Si aucune erreur, Verifier DB et création
                if(empty($errors)) {
                    if(!empty($this->getModel()->findByEmail())) {
                            $errors[] =  "Un compte existe déjà avec cette adresse email.";
                    }
                    elseif(!empty($this->getModel()->findByPseudo())) {
                            $errors[] =  "Un compte existe déjà avec ce pseudo.";
                    } 
                    else {

                        $this->getModel()->setEmail($email);
                        // Inscription réussie
                        $userData = [
                            'email'=> $email,
                            'pseudo'=>$pseudo,
                            'password'=>password_hash($password,PASSWORD_DEFAULT)
                        ];

                        $this->getModel()->create_user($userData);

                        $success = "Le compte ". htmlspecialchars($email,ENT_QUOTES,'UTF-8'). " à été créé avec succès.";
                    }
                }
            }
    }
}