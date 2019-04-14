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
class AdminArticleManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'articles';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $values
     * @return int
     */
    public function insert(array $values): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table 
            (title, `date`, author, category, shortText, tag, content) 
            VALUES (:title, :udate, :author, :category, :shortText, :tag, :content)");
        $statement->bindValue('title', $values['title'], \PDO::PARAM_STR);
        $statement->bindValue('udate', $values['date'], \PDO::PARAM_STR);
        $statement->bindValue('author', $values['author'], \PDO::PARAM_STR);
        $statement->bindValue('category', $values['selectCat'], \PDO::PARAM_STR);
        $statement->bindValue('shortText', $values['shortText'], \PDO::PARAM_STR);
        $statement->bindValue('tag', $values['tag'], \PDO::PARAM_STR);
        $statement->bindValue('content', $values['content'], \PDO::PARAM_STR);

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
}
