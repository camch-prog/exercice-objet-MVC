<?php
function displayArticles(){
    //1. Effectuer la connexion à la BDD
    

    //2. Appel du model pour récupérer les données des articles
    $data = getArticles();

    //3. Appel de la view pour afficher les data
    $title = "Mes Articles";
    include('./view/viewHeader.php');
    include('./view/viewArticle.php');
    include('./view/viewFooter.php');
}