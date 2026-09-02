<?php
namespace Controller;

use Controller\Controller;
use View\View;
use Model\ModelArticle;
use Model\ModelUser;

class ControllerArticle extends Controller{

    private ?modelUser $modelUser;

    public function __construct(ModelArticle $modelArticle, View $view,  ?ModelUser $modelUser) {
        parent::__construct($modelArticle, $view);
        $this->modelUser = $modelUser;
    }

    public function addArticle() {
        if (isset($_POST["submit"])) {

            if (empty($_SESSION["id"])){
                $this->getView()->setMessage("Vous devez vous connecter pour ajouter un Article");
                return;
            }

            if (empty($_POST["title"]) || empty($_POST["content"])){
                $this->getView()->setMessage("Veuillez remplir tous les champs");
                return;
            }

        $this->getModel()->setTitle($_POST["title"]);
        $this->getModel()->setContent($_POST["title"]);
        if (!empty($_SESSION["id"])) $this->getModel()->setAuthorId($_SESSION["id"]);

        if($this->getModel()->isArticleTitleExists()){
            $this->getView()->setMessage("Ce titre d'article existe déjà");
            return;
        }
        $this->getModel()->createArticle();

        }
    }

    public function deleteArticle(): void{
        
        $password = $_POST["password"] ?? '';
        if(isset($_POST["validate"]) ){
            if(empty($_POST["password"])) {
                $this->getView()->setMessageDelete("Vous devez entrez votre mot de passe pour supprimer l'article");
                return;
            }
        
        if(empty($password)) {
                    $this->getView()->setMessageDelete("Veuillez rentrer votre mot de passe.");
                    return;
        }


        $this->getModel()->setTitle($_POST["articleTitle"]);
        $this->modelUser->setEmail($_SESSION["email"]);
        $user = $this->modelUser->findByEmail();


        if(password_verify($password,$user["password"])) {

                $this->getView()->setMessageDelete("L'article ".$this->getModel()->getTitle()." à été supprimé");
                $this->getModel()->deleteArticle();
                return;
            
        }
        else {
            $this->getView()->setMessageDelete("Le mot de passe n'est pas bon");
            return;
        }
    }

    }

    public function renderMesArticles():void{
        //1. Appel du model pour récupérer les données des articles
        if (!empty($_SESSION["id"])) $this->getModel()->setAuthorId($_SESSION["id"]);
        $data = $this->getModel()->findAllOwn();
        //2.Passage des data à la View et son Appel pour afficher les data traitées
        $this->getView()->setData($data)->displayAll();
    }

    public function modifyContent(): void {
        if(isset($_POST["submit"])) {
            // Validation de l'ID et du contenu
            if(empty($_GET["id"])) {
                $this->getView()->setMessage("ID de l'article manquant");
                return;
            }
            if(empty($_POST["content"])) {
                $this->getView()->setMessage("Veuillez entrer un contenu");
                return;
            }
            
            $this->getModel()->setId($_GET["id"]);
            $this->getModel()->setContent($_POST["content"]);
            $this->getModel()->modify_Content();
            $this->getView()->setMessage("Article modifié avec succès");
        }
    }

    public function displayOnearticle():void {
            $this->getModel()->setId($_GET["id"]);
            $data=$this->getModel()->findThisArticle();
            $this->getView()->setData($data)->displayAll();
    }
}