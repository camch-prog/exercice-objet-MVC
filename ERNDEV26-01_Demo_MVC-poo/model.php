<?php
function getUser($bdd){
    //2. Préparer une requête pour SELECT les utilisateurs
    $req = $bdd->prepare('SELECT pseudo, email, role FROM user INNER JOIN role ON role.id = user.role_id');

    $req->execute();

    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function createUser(){
    //requete pour enrtegistrer un utilisateur
}

function deleteUser(){
    //requete pour enrtegistrer un utilisateur
}
