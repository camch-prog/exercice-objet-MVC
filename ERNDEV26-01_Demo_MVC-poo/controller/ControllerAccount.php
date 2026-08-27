<?php 
namespace Controller;


class ControllerAccount extends Controller{
    public function render():void{
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
}