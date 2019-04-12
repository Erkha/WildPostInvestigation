<?php

namespace App\Model;

use \PDO;

class AdminRegisterManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'userAdmin';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function userAdminExist ($username, $password) {
        $ok = null;       
        $userRes = $this->pdo->query("SELECT username FROM $this->table WHERE username = '"
                            .$username."' AND password = '".$password."'" );
        
        $adminRech = $userRes->fetch(PDO::FETCH_ASSOC);
        
        if (empty($adminRech)){
            $ok = 'error identification !!'; // not exist
        }
        else {
            $ok = null; // exist
        }       
        return $ok;
    }

}
