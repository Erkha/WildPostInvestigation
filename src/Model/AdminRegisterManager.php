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
        $userRes = $this->pdo->query("SELECT username FROM $this->table WHERE username = '"
                            .$username."' AND password = '".$password."'");
        
        $adminRech = $userRes->fetch(PDO::FETCH_ASSOC);
        
        if (empty($adminRech)) {
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
        $statement->bindvalue('valid', 0, \PDO::PARAM_INT);
       
        
        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
}
