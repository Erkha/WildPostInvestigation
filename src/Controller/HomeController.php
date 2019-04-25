<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */
namespace App\Controller;

use App\Model\AdminArticleManager;

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
        return $this->twig->render('Home/index.html.twig');
    }

    /**
     * [article description]
     * @param  int $id [description]
     * @return string     [description]
     */
    public function article($id)
    {
        $articleManager = new AdminArticleManager();
        $article = $articleManager->selectOneById($id);
        return $this->twig->render('Home/article.html.twig', [
            'article'=>$article]);
    }
}
