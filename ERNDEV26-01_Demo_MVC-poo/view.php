<?php
//Déclaration de ma variable d'affichage
$listeUtilisateur = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header></header>
    <main>
        <h1>Liste des utilisateurs</h1>
        <ul>
            <?php 
                foreach($data as $row){
                    $listeUtilisateur .="<li>Pseudo :".$row['pseudo']." - Email : ".$row['email']." - Role :".$row['role']."</li>";
                };
                echo $listeUtilisateur;
            ?>
        </ul>
    </main>
    <footer></footer>
</body>
</html>