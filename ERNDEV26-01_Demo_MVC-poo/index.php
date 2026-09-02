<?php
//ROUTEUR
//Autoloader de Composer
//AVANTAGE : les namespaces n'ont plus besoin de se conformer à l'arborescence
//De plus, il est possible de faire un auto-include des fichiers ne comportant pas de class (voir composer.json)
//1. Créer le fichier composer.json
//2. Dans un terminal ouvert dans votre projet, lancer composer install  (pour intaller le dossier ./vendor)
//3. Ajouter le dossier ./vendor au .gitignore
//4. require du fichier php qui s'occupera de l'autoload
require_once __DIR__ . '/vendor/autoload.php';

use Controller\ControllerUser as MonUser; // avec AS je fourni un alias au nom de ma classe
use Controller\ControllerArticle;
use Controller\ControllerAccount;
use Model\ModelUser;
use Model\ModelArticle;
use View\ViewUser;
use View\ViewArticle;
use View\ViewOneArticle;
use View\ViewMesArticles;
use View\ViewAccount;
use Utils\Utils;

session_start();
//1. Récupérer l'url demandé par l'utilisateur
$url = parse_url($_SERVER['REQUEST_URI']);

//2. Récupérer le path de l'url : ceux qui vient après le nom de domaine
$path = isset($url['path']) ? $url['path'] : '/';

//3. Appeler le Controller lié à la route demandée
switch ($path) {
    case '/':
    case $_ENV['utilisateurs']:
        // utilisation de l'alias pour le Controller\ControllerUser
        $controller = new MonUser(new ModelUser(Utils::connect()), new ViewUser("Utilisateurs","./public/src/script/scriptUser.js"));
        $controller->seConnecter();
        $controller->registerUser();
        $controller->render();
        break;
    case $_ENV['articles'] :
        $controller = new ControllerArticle(new ModelArticle(Utils::connect()), new ViewArticle("Articles","./public/src/script/scriptArticle.js"),null);
        $controller->render();
        break;

    case $_ENV['oneArticle'] :
        $controller = new ControllerArticle(new ModelArticle(Utils::connect()), new ViewOneArticle("Articles","./public/src/script/scriptArticle.js"),null);
        
        $controller->modifyContent();
        $controller->displayOnearticle();
        break;

    case $_ENV['mesArticles'] :
        $controller = new ControllerArticle(new ModelArticle(Utils::connect()), new ViewMesArticles("Mes articles","./public/src/script/scriptArticle.js"),new ModelUser(Utils::connect()) );
        $controller->addArticle();
        $controller->deleteArticle();
        $controller->renderMesArticles();
        break;
    case $_ENV['compte'] :
        if(!isset($_SESSION["id"])){
            $controller = new MonUser(new ModelUser(Utils::connect()), new ViewUser("Utilisateurs","./public/src/script/scriptUser.js"));
            $controller->seConnecter();
            $controller->registerUser();
            $controller->render();
        }else{
        $controller = new ControllerAccount(new ModelUser(Utils::connect()), new ViewAccount("Compte","./public/src/script/scriptArticle.js"));
        $controller->deleteAccount();
        $controller->render();
        break;}
    case $_ENV['deco'] : 
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();
        header("Location: /");
        exit;
    default:
        echo "erreur 404";
        break;
}
