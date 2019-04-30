<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */
namespace App\Controller;

use App\Model\AdminArticleManager;
use App\Model\CategoryManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $articleManager = new AdminArticleManager();
        $articles = $articleManager->selectPublishedArticlesWithJoin();
        $categoryManager = new CategoryManager();
        $categorie = $categoryManager->selectAll();
        //var_dump($articles);
        return $this->twig->render('Home/index.html.twig', ['articles' => $articles,'categoryAll'=> $categorie]);
    }

    /**
     * [article description]
     * @param  int $id [description]
     * @return string     [description]
     */
    public function article($id)
    {
        $articleManager = new AdminArticleManager();
        $article = $articleManager->selectArticleByIdwithCatName($id);
        $categoryManager = new CategoryManager();
        $categorie = $categoryManager->selectAll();
        return $this->twig->render('Home/article.html.twig', [
            'article'=>$article,'categoryAll'=> $categorie]);
    }
}
