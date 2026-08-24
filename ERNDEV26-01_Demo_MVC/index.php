<?php
//ROUTEUR
//import des ressources
include('./env.php');
include('./utils/utils.php');
include('./model/modelUser.php');
include('./model/modelArticle.php');
include('./view/viewFooter.php');
include('./view/viewArticle.php');
include('./view/viewHeader.php');
include('./view/viewUser.php');
include('./controller/controllerUsers.php');
include('./controller/controllerArticle.php');

//1. Récupérer l'url demandé par l'utilisateur
$url = parse_url($_SERVER['REQUEST_URI']);

//2. Récupérer le path de l'url : ceux qui vient après le nom de domaine
$path = isset($url['path']) ? $url['path'] : '/';

//3. Appeler le Controller lié à la route demandée
switch ($path) {
    case '/':
    case $_ENV['utilisateurs']:
        $controller = new ControllerUser(new ModelUser(connect()), new ViewUser());
        $controller->render();
        break;
    case $_ENV['articles'] :
        $controller = new ControllerArticle(new ModelArticle(connect()));
        $controller->displayArticles();
        break;
    default:
        echo "erreur 404";
        break;
}
