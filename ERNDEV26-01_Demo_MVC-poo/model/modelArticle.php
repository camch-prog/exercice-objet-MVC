<?php
namespace Model;

use Exception as GlobalException;
use PDO, EXCEPTION;
use Model\Model;

class ModelArticle extends Model{
    //ATTRIBUT
    private ?string $id;
    private ?string $title;
    private ?string $content;
    private ?string $createdAt;
    private ?string $editedAt;
    private ?int $authorId;
    private ?string $author;

    //CONSTRUCTEUR
    
    //GETTER ET SETTER
    public function setTitle(string $title) {
        $this->title=$title;
    }
    public function getTitle(): string {
        return $this->title;
    }
    public function setContent(string $content) {
        $this->content=$content;
    }
    public function setAuthorId(int $authorId) {
        $this->authorId=$authorId;
    }
    public function setId(string $id) {
        $this->id=$id;
    }

    //METHODS
    public function findAll():?array{
        try{
            //1. Preparer la requête
            $request = 'SELECT a.id, a.title, a.content, a.created_at, a.edited_at, u.pseudo FROM article a INNER JOIN user u ON u.id = a.user_id';

            $req = $this->getBDD()->prepare($request);

            //2. Exécution de la requête
            $req->execute();

            //3. Retourner les données
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){
            die($error->getMessage());
        }
    }
    public function createArticle():void {
        try {
            $sql = 'INSERT INTO article (title, content, user_id) VALUE (?,?,?)';
            $req = $this->getBDD()->prepare($sql);
            $req->bindvalue(1,$this->title,PDO::PARAM_STR);
            $req->bindvalue(2,$this->content,PDO::PARAM_STR);
            $req->bindvalue(3,$this->authorId,PDO::PARAM_INT);
            $req->execute();

        } catch(EXCEPTION $error) {
            die($error->getMessage());
        }
    }

    public function isArticleTitleExists():bool {
        try {
            $sql = 'SELECT id FROM article WHERE title = ?';
            $req = $this->getBDD()->prepare($sql);
            $req->bindvalue(1,$this->title,PDO::PARAM_STR);
            $req->execute();
            $data=$req->fetch(PDO::FETCH_ASSOC);
            if(!empty($data)){
                return true;
            } else {
                return false;
            }

        } catch(EXCEPTION $error) {
            die($error->getMessage());
        }
    }

    public function findAllOwn():?array{
        try{
            $request = 'SELECT a.id, a.title, a.content, a.created_at, a.edited_at, u.pseudo FROM article a INNER JOIN user u ON u.id = a.user_id WHERE user_id = ?';

            $req = $this->getBDD()->prepare($request);
            $req->bindvalue(1,$this->authorId,PDO::PARAM_INT);
            $req->execute();

            //3. Retourner les données
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){
            die($error->getMessage());
        }
    }

    public function findThisArticle() {
        try{
            $sql = 'SELECT a.id, a.title, a.content, a.created_at, a.edited_at, u.pseudo FROM article a INNER JOIN user u ON u.id = a.user_id WHERE a.id = ?';

            $req = $this->getBDD()->prepare($sql);
            $req->bindValue(1,$this->id,PDO::PARAM_STR);
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){
            die($error->getMessage());
        }
    }

    public function modify_Content(): void {
        try{
            $sql = 'UPDATE article SET content = ? WHERE id = ?';
            $request = $this -> getBDD() -> prepare($sql);
            $request -> bindvalue(1,$this->content,PDO::PARAM_STR);
            $request -> bindvalue(2,$this->id,PDO::PARAM_STR);
            $request -> execute();
        } catch (EXCEPTION $e) {
            error_log($e->getMessage());
        }
    }

    public function deleteArticle(): void{
        try{
            $sql = 'DELETE FROM article WHERE title = ?';
            $request = $this -> getBDD() -> prepare($sql);
            $request -> bindvalue(1,$this->title,PDO::PARAM_STR);
            $request -> execute();
            if($request->rowCount() === 0) {
            error_log("Aucun article trouvé avec l'ID: " . $this->id);
        }
        } catch (EXCEPTION $e) {
            error_log($e->getMessage());
        }
    } 
}
