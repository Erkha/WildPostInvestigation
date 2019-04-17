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
            (title, articleDate, author, category, tag, content,topArt, published) 
            VALUES (:title, :articleDate, :author, :category,
                    :tag, :content, :topArt, :published)");
        $statement->bindValue('title', $values['title'], \PDO::PARAM_STR);
        $statement->bindValue('articleDate', $values['articleDate'], \PDO::PARAM_STR);
        $statement->bindValue('author', $values['author'], \PDO::PARAM_STR);
        $statement->bindValue('category', $values['category'], \PDO::PARAM_STR);
        $statement->bindValue('tag', $values['tag'], \PDO::PARAM_STR);
        $statement->bindValue('content', $values['content'], \PDO::PARAM_STR);
        $statement->bindValue('topArt', $values['topArt'], \PDO::PARAM_BOOL);
        $statement->bindValue('published', $values['published'], \PDO::PARAM_BOOL);

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

        /**
     * @param array $values
     * @return bool
     */
    public function edit(array $values):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table 
            SET title = :title,
                articleDate = :articleDate,
                author = :author,
                category = :category,
                tag = :tag,
                topArt = :topArt,
                published = :published,
                content = :content WHERE id=:id");
        $statement->bindValue(':id', $values['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $values['title'], \PDO::PARAM_STR);
        $statement->bindValue('articleDate', $values['articleDate'], \PDO::PARAM_STR);
        $statement->bindValue('author', $values['author'], \PDO::PARAM_STR);
        $statement->bindValue('category', $values['category'], \PDO::PARAM_STR);
        $statement->bindValue('tag', $values['tag'], \PDO::PARAM_STR);
        $statement->bindValue('content', $values['content'], \PDO::PARAM_STR);
        $statement->bindValue('topArt', $values['topArt'], \PDO::PARAM_BOOL);
        $statement->bindValue('published', $values['published'], \PDO::PARAM_BOOL);

        return $statement->execute();
    }
}
