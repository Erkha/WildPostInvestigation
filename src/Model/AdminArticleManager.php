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
     * @param array $value
     * @return int
     */
    public function insert(array $value): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table 
            (title, `date`, author, category, shortText, tag, content) 
            VALUES (:title, :udate, :author, :category, :shortText, :tag, :content)");
        $statement->bindValue('title', $value['title'], \PDO::PARAM_STR);
        $statement->bindValue('udate', $value['date'], \PDO::PARAM_STR);
        $statement->bindValue('author', $value['author'], \PDO::PARAM_STR);
        $statement->bindValue('category', $value['selectCat'], \PDO::PARAM_STR);
        $statement->bindValue('shortText', $value['shortText'], \PDO::PARAM_STR);
        $statement->bindValue('tag', $value['tag'], \PDO::PARAM_STR);
        $statement->bindValue('content', "salut", \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
}
