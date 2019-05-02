<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class AdminLiveManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'live';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


  /**
     * @param array $addLive
     * @return int
     */
    public function insert(array $addLive): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`content`, `articleDate`) 
            VALUES (:content, :articleDate)");
        $statement->bindValue(':content', $addLive['content'], \PDO::PARAM_STR);
        $statement->bindValue(':articleDate', $addLive['articleDate'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


//     /**
//      * @param array $item
//      * @return bool
//      */
    public function update(array $live):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `content` = :content WHERE id=:id");
        $statement->bindValue('id', $live['id'], \PDO::PARAM_INT);
        $statement->bindValue('content', $live['content'], \PDO::PARAM_STR);

        return $statement->execute();
    }


      /**
     * Get all row from database live.
     *
     * @return array
     */
    public function liveManage(): array
    {
        return $this->pdo->query("SELECT * FROM $this->table ORDER BY articleDate")->fetchAll();
    }
}
