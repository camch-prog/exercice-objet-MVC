<?php
class ModelArticle {
    private ?string $title;
    private ?string $content;
    private ?string $created_at;
    private ?string $edited_at;
    private ?string $pseudo;
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getArticles(){
    try{
        
        //1. Preparer la requête
        $request = $this->db->prepare('SELECT a.title, a.content, a.created_at, a.edited_at, u.pseudo FROM article a INNER JOIN user u ON u.id = a.user_id');

        //2. Exécution de la requête
        $request->execute();

        //3. Retourner les données
        return $request->fetchAll(PDO::FETCH_ASSOC);
        
    }catch(EXCEPTION $error){
        die($error->getMessage());
    }
}
}
