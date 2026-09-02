<?php
//Class ModelUser
namespace Model;

use Model\Model;
use PDO, PDOException ;

//extends : la propriété pour l'héritage. Ici ModelUser hérite de la class Model
class ModelUser extends Model{
    //ATTRIBUTS
    //les attributs d'un model doivent correspondrent aux champs de la table correspondante en BDD
    private ?int $id; // le ? signifie que l'attribut a le droit d'être null
    private ?string $pseudo;
    private ?string $email;
    private ?string $password;
    private ?string $createdAt;
    private ?string $role;

    //CONSTRUCTEUR

    //GETTER ET SETTER

    //METHODS
    public function findAll():?array{
        try{
            //1. Préparer une requête pour SELECT les utilisateurs
            //On utilise l'objet PDO stocké dans l'attribut bdd de notre model ($this->bdd)
            $req = $this->getBDD()->prepare('SELECT u.id, u.pseudo, u.email, u.password, u.created_at, r.role FROM user u INNER JOIN role r ON r.id = u.role_id');

            //2. Exécution de la requête
            $req->execute();

            //3. Return des données utilisateurs
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }catch(EXCEPTION $error){
            die($error->getMessage());
        }
    }

    public function  findByEmail():array {
        try{
            $sql = "SELECT u.id,u.email,u.pseudo,u.password,u.created_at,u.role_id FROM user AS u WHERE u.email = ? ";

            $request = $this ->getBDD() -> prepare($sql);
            $request -> bindValue(1,$this->email,PDO::PARAM_STR);
            $request -> execute();
            $user = $request -> fetch(PDO::FETCH_ASSOC);
            return $user ?: [];

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function findByPseudo():array {
        try {
            $sql = "SELECT u.id,u.email,u.pseudo,u.password,u.created_at,u.role_id FROM user AS u WHERE u.pseudo = ?";

            $request = $this -> getBDD() -> prepare($sql);
            $request -> bindValue(1,$this->pseudo,PDO::PARAM_STR);
            $request -> execute();
            $user = $request -> fetch(PDO::FETCH_ASSOC);
            return $user ?: [];

        } catch( PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public  function create_user(array $user): void {
        try{
            $sql = "INSERT INTO user(pseudo,email,`password`) VALUE (?,?,?)";

            $request = $this -> getBDD() -> prepare($sql);
            $request -> bindvalue(1,$this->pseudo,PDO::PARAM_STR);
            $request -> bindvalue(2,$this->email,PDO::PARAM_STR);
            $request -> bindvalue(3,$this->password,PDO::PARAM_STR);
            $request -> execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    } 

    public function deleteAccount() {
        try{
            $sql = "DELETE FROM user WHERE id = ?";

            $request = $this -> getBDD() -> prepare($sql);
            $request -> bindvalue(1,$this->id,PDO::PARAM_STR);
            $request -> execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
    
    public function setPseudo (string $pseudo) {
        $this->pseudo =$pseudo;
    }
    public function setId (string $id) {
        $this->id =$id;
    }
    public function setEmail (string $email) {
        $this->email =$email;
    }
    public function setPassword (string $password) {
        $this->password =$password;
    }

    
}
