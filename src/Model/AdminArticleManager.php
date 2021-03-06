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

use \PDO;

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
    public function selectArticlesWithJoin(): array
    {
        return $this->pdo->query('  SELECT a.*, c.name as catName, lastname, firstname FROM articles a
                                    JOIN category c ON a.categoryId = c.id
                                    JOIN authors u ON a.authorId = u.id
            ')->fetchAll();
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectPagedArticlesWithJoin($page = 1): array
    {
        return $this->pdo->query('  SELECT a.*, c.name as catName, lastname, firstname FROM articles a
                                    JOIN category c ON a.categoryId = c.id
                                    JOIN authors u ON a.authorId = u.id
                                    LIMIT '.($page-1) *5 .',5')->fetchAll();
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function countArticles()
    {
        return $this->pdo->query('SELECT count(id) as nb FROM articles') ->fetch();
    }

    public function checkArticlesOnCategory(int $catId) :array
    {
        $statement = $this->pdo->prepare('SELECT count(id) as nb FROM articles 
                            WHERE categoryId = :catId');
        $statement->bindValue('catId', $catId, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }


    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectPublishedArticlesWithJoin(): array
    {
        return $this->pdo->query('  SELECT a.*, c.name as catName, lastname, firstname FROM articles a
                                    JOIN category c ON a.categoryId = c.id
                                    JOIN authors u ON a.authorId = u.id
                                    WHERE published = 1
            ')->fetchAll();
    }
    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectArticleByIdwithCatName(int $id): array
    {
        $statement=$this->pdo->prepare('SELECT a.*, c.name as catName, lastname, firstname FROM articles a
                                    JOIN category c ON a.categoryId = c.id
                                    JOIN authors u ON a.authorId = u.id
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
            (title, articleDate, authorId, categoryId, tag, content,topArt, published, imageName) 
            VALUES (:title, :articleDate, :authorId, :categoryId,
                    :tag, :content, :topArt, :published, :imageName)");
        $statement->bindValue('title', $values['title'], \PDO::PARAM_STR);
        $statement->bindValue('articleDate', $values['articleDate'], \PDO::PARAM_STR);
        $statement->bindValue('authorId', $values['authorId'], \PDO::PARAM_STR);
        $statement->bindValue('categoryId', $values['categoryId'], \PDO::PARAM_STR);
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
                authorId = :authorId,
                categoryId = :categoryId,
                tag = :tag,
                topArt = :topArt,
                published = :published,
                imageName = :imageName,
                content = :content WHERE id=:id");
        $statement->bindValue(':id', $values['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $values['title'], \PDO::PARAM_STR);
        $statement->bindValue('articleDate', $values['articleDate'], \PDO::PARAM_STR);
        $statement->bindValue('authorId', $values['authorId'], \PDO::PARAM_INT);
        $statement->bindValue('categoryId', $values['categoryId'], \PDO::PARAM_INT);
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


    /* liste articles par recherche (search) */
    public function searchArticles($search)
    {
        $articlesRes = $this->pdo->prepare("SELECT * FROM $this->table 
                    INNER JOIN category ON category.id = $this->table.categoryId
                    INNER JOIN authors ON  authors.id = $this->table.authorId
                    WHERE published = 1
                    AND (title LIKE :title OR content LIKE :content )");
        $articlesRes->bindValue('title', '%'.$search.'%', \PDO::PARAM_STR) ;
        $articlesRes->bindValue('content', '%'.$search.'%', \PDO::PARAM_STR) ;
        $articlesRes->execute();
        return $articlesRes-> fetchAll();
    }
    
    public function countSearchArticles($search)
    {
        $articlesRes = $this->pdo->prepare("SELECT count($this->table.id) as nb FROM $this->table 
                    WHERE published = 1
                    AND (title LIKE :title OR content LIKE :content )");
        $articlesRes->bindValue('title', '%'.$search.'%', \PDO::PARAM_STR) ;
        $articlesRes->bindValue('content', '%'.$search.'%', \PDO::PARAM_STR) ;
        $articlesRes->execute();
        return $articlesRes-> fetch();
    }

    public function searchArticlesPagination($search, $page = 1)
    {
        $page = ($page-1)*5;
        $articlesRes = $this->pdo->prepare("SELECT * FROM $this->table 
                    INNER JOIN category ON category.id = $this->table.categoryId
                    INNER JOIN authors ON  authors.id = $this->table.authorId
                    WHERE published = 1
                    AND (title LIKE :title OR content LIKE :content )
                    LIMIT :pagination ,5");
        $articlesRes->bindValue('title', '%'.$search.'%', \PDO::PARAM_STR) ;
        $articlesRes->bindValue('content', '%'.$search.'%', \PDO::PARAM_STR) ;
        $articlesRes->bindValue('pagination', $page, \PDO::PARAM_INT) ;
        $articlesRes->execute();
        return $articlesRes-> fetchAll();
    }


    /* fin partie search */

    public function selectPublishedCategoriesWithJoin($id): array
    {
        $statement=$this->pdo->prepare('  SELECT a.*, c.name as catName, lastname, firstname FROM articles a
                                    JOIN category c ON a.categoryId = c.id
                                    JOIN authors u ON a.authorId = u.id
                                    WHERE c.id=:id');

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function countPublishedCategoriesWithJoin($id) :array
    {
        $statement=$this->pdo->prepare('  SELECT count(a.id)as nb FROM articles a
                                    JOIN category c ON a.categoryId = c.id
                                    JOIN authors u ON a.authorId = u.id
                                    WHERE c.id=:id AND published = 1');

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function selectPagedCategorizedArticlesWithJoin($id, $page = 1): array
    {
        $statement=$this->pdo->prepare('  SELECT a.*, c.name as catName, lastname, firstname FROM articles a
                                    JOIN category c ON a.categoryId = c.id
                                    JOIN authors u ON a.authorId = u.id
                                    WHERE c.id=:id AND published = 1
                                    LIMIT '.($page-1) *5 .',5');
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}
