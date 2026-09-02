<?php 
namespace Controller;


class ControllerAccount extends Controller{
    public function render():void {
        
        //1. Appel du model pour récupérer les données des articles
        $data = [
            "email"=>$_SESSION["email"] ?? null,
            "pseudo"=>$_SESSION["pseudo"]?? null,
            "id"=>$_SESSION["id"]?? null,
            "role_id"=>$_SESSION["role_id"]?? null,
            "created_at"=>$_SESSION["created_at"]?? null,
        ];
        //2.Passage des data à la View et son Appel pour afficher les data traitées
        $this->getView()->setData($data)->displayAll();
    }

    public function deleteAccount(): void {
        $message="";
        $password = $_POST["password"] ?? '';
        //Verification que le formulaire soit envoyé
        if(isset($_POST["validate"]) ){
            if(empty($_POST["password"])) {
                $message.= "<li>Il vous faut rentrer votre mot de passe pour supprimer le compte</li>";
            }
        
        if(empty($password)) {
                    $message .= "<li>Veuillez rentrer votre mot de passe.</li>";
        }
        $this->getModel()->setEmail($_SESSION["email"]);
        $user = $this->getModel()->findByEmail();

        if(empty($message)&& password_verify($password,$user["password"])) {
            $this->getModel()->setId($_SESSION["id"]);
            $this->getView()->setMessage("Le compte à été supprimé");
            $_SESSION = [];
                session_destroy();
                $this->getModel()->deleteAccount();
                header("Location: /");
                ;
                exit;
            
        }
        else {
            $message.= "Le mot de passe n'est pas bon ";
        }
        $this->getView()->setMessage($message);
        }
    }

    
}