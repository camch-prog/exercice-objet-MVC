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
}