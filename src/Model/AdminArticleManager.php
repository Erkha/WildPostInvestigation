<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */


//TODO :add a method of select all sorted by top, more recent

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
     * Get all row from database.
     *
     * @return array
     */
    public function selectArticleswithCatName(): array
    {
        return $this->pdo->query('  SELECT a.*, c.name as catName FROM articles a
                                    JOIN category c ON a.category = c.id
            ')->fetchAll();
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectArticleByIdwithCatName(int $id): array
    {
        $statement=$this->pdo->prepare('  SELECT a.*, c.name as catName FROM articles a
                                    JOIN category c ON a.category = c.id
                                    WHERE a.id=:id');
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }


    /**
     * @param array $values
     * @return int
     */
    public function insert(array $values): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table 
            (title, articleDate, author, category, tag, content,topArt, published, imageName) 
            VALUES (:title, :articleDate, :author, :category,
                    :tag, :content, :topArt, :published, :imageName)");
        $statement->bindValue('title', $values['title'], \PDO::PARAM_STR);
        $statement->bindValue('articleDate', $values['articleDate'], \PDO::PARAM_STR);
        $statement->bindValue('author', $values['author'], \PDO::PARAM_STR);
        $statement->bindValue('category', $values['category'], \PDO::PARAM_STR);
        $statement->bindValue('tag', $values['tag'], \PDO::PARAM_STR);
        $statement->bindValue('content', $values['content'], \PDO::PARAM_STR);
        $statement->bindValue('topArt', $values['topArt'], \PDO::PARAM_BOOL);
        $statement->bindValue('published', $values['published'], \PDO::PARAM_BOOL);
        $statement->bindValue('imageName', $values['imageName'], \PDO::PARAM_STR);

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
     * [update an article in DB]
     * @param  array  $values [elements of article]
     * @return bool       [description]
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
                imageName = :imageName,
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
        $statement->bindValue('imageName', $values['imageName'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * [topArtEmpty description]
     * @return bool [description]
     */
    public function topArtEmpty():bool
    {
        $statement = $this->pdo->prepare("UPDATE $this->table 
            SET topArt = false WHERE topArt = true");
        return $statement->execute();
    }
}
