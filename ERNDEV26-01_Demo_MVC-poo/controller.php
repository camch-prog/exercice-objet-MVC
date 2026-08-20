<?php
//CONTROLLER
//Import des ressources
include('utils.php');
include('model.php');

//1.Connexion à la BDD
$bdd = connect();

//Appel du model pour récupération des données
$data = getUser($bdd);

//3. Traiter les données pour ensuite les afficher
// foreach($data as $row){
//     $listeUtilisateur .="<li>Pseudo :".$row['pseudo']." - Email : ".$row['email']." - Role :".$row['role']."</li>";
// }

//Appel de la view pour effectuer l'affichage
include('view.php');