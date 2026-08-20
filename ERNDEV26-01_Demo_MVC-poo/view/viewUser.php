<?php
//Déclaration de ma variable d'affichage
$listeUtilisateur = '';
?>


    <main>
        <h1>Liste des utilisateurs</h1>
        <ul>
            <?php
                //traitement des données pour affichage 
                foreach($data as $row){
                    $listeUtilisateur .="<li>Pseudo :".$row['pseudo']." - Email : ".$row['email']." - Role :".$row['role']."</li>";
                };
                echo $listeUtilisateur;
            ?>
        </ul>
    </main>
