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
        $categories = $categoryManager->selectAll();
        return $this->twig->render('Home/index.html.twig', ['articles' => $articles,'categoryAll'=> $categories]);
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
        $categories = $categoryManager->selectAll();
        return $this->twig->render('Home/article.html.twig', [
            'article'=>$article,
            'categoryAll'=> $categories]);
    }

    public function categorieVu($id, $page = 1)
    {
        $articleManager = new AdminArticleManager();
        $nbArticles = $articleManager->countPublishedCategoriesWithJoin($id);
        $nbPages = ceil($nbArticles['nb']/5);
        $articles = $articleManager->selectPagedCategorizedArticlesWithJoin($id, $page);
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAll();
        $titleCategorie = $categoryManager->selectOneById($id);

        return $this->twig->render(
            'Home/articleList.html.twig',
            ['articles' => $articles,
            'categoryAll'=> $categories,
            'titlePage'=>$titleCategorie,
            'pages'=> $nbPages]
        );
    }
}
