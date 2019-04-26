<?php

namespace App\Model;

use \PDO;

class AdminRegisterManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'authors';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function userAdminExist($username, $password, $sign)
    {
        $ok = null;
        $userCpt = $this->pdo->query("SELECT count(*) as cpteur FROM $this->table ");
        $adminCptRech = $userCpt->fetch(PDO::FETCH_ASSOC);
        $adminRech=[];
        if ($sign=='UP') {
            $userRes = $this->pdo->query("SELECT count(*) as exist FROM $this->table WHERE username = '"
                            .$username."' or password = '".$password."'");
            $adminRech = $userRes->fetch(PDO::FETCH_ASSOC);
        } 
        if ($sign=='IN') {
            $userRes = $this->pdo->query("SELECT id as exist FROM $this->table WHERE username = '"
                            .$username."' or password = '".$password."'");
            $adminRech = $userRes->fetch(PDO::FETCH_ASSOC);
        }     
        

        if ( $adminCptRech['cpteur']> 0 && ( ($adminRech['exist']>0  && $sign=='UP') 
                    || ( empty($adminRech) && $sign=='IN'))) {
            if ($sign == 'IN') {
                $ok = 'error identification !!'; // not exist
            } else {
                $ok = 'username or password already exist';
            }
        } else {
            $ok = null; // exist
        }
        return $ok;
    }


    public function authorExist($lastname, $firstname)
    {
        $ok = null;
        $authorRes = $this->pdo->query("SELECT username FROM $this->table WHERE lastname = '"
                            .$lastname."' AND firstname = '".$firstname."'");
        
        $authorRech = $authorRes->fetch(PDO::FETCH_ASSOC);
        
        if (empty($authorRech)) {
            $ok = null; // not exist
        } else {
            $ok = 'Author is exist'; // exist
        }
        return $ok;
    }

    /**
     * @param array $values
     * @return int
     */
    public function authorInsert(array $values): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table 
            (lastname, firstname, username, `password`, valid) 
            VALUES (:lastname, :firstname, :username, :ppassword, :valid)");
        $statement->bindValue('lastname', $values['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $values['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('username', $values['username'], \PDO::PARAM_STR);
        $statement->bindValue('ppassword', $values['password'], \PDO::PARAM_STR);
        $statement->bindvalue('valid', null, \PDO::PARAM_INT);
       
        
        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function authorUpdateBdd(array $values):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `valid` = :valid WHERE id=:id");
        $statement->bindValue('id', $values['id'], \PDO::PARAM_INT);
        $statement->bindValue('valid', $values['valid'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function authorListNotValidated()
    {
        $authorRes = $this->pdo->query("SELECT * FROM $this->table WHERE valid is NULL or valid = FALSE");

        $authorRech = $authorRes->fetchall(PDO::FETCH_ASSOC);
        return $authorRech;
    }

    public function showAuthor(int $id)
    {
        $authorManager = new AdminRegisterManager();
        $author = $authorManager->selectOneById($id);

        return $author;
    }
}
