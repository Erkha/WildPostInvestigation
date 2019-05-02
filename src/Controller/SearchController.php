<?php
/**
 * Created by PhpStorm.
 * User: nath
 * Date: 30/04/19
 * Time: 10:40
 */

namespace App\Controller;

use App\Model\AdminArticleManager;  // utilisation de la class AdminArticleManager
use App\Model\CategoryManager;
use App\Model\AdminLiveManager;

class SearchController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    

    public function searchArticles(INT $page = 1)
    {

        if (($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['search']))
            || $_SERVER['REQUEST_METHOD']==='GET') {
            if ($_SERVER['REQUEST_METHOD']==='POST') {
                $critere = $_POST['search'];
                $_SESSION['search'] = $critere;
            }
                $critere = $_SESSION['search'];
                $articleManager = new AdminArticleManager();
                
                //$articles = $articleManager->searchArticles($critere);
                $articles = $articleManager->searchArticlesPagination($critere, $page);
                $nbArticles = $articleManager->countSearchArticles($critere);
                $nbPages = ceil($nbArticles['nb']/5);
                
                $categoryManager = new CategoryManager();
                $categories = $categoryManager->selectAll();

                $adminLiveManager = new AdminLiveManager();
                $lives = $adminLiveManager->liveManage();
                
            
                return $this->twig->render(
                    'Search/search.html.twig',
                    ['articles' => $articles,'categoryAll'=> $categories, 'pages'=> $nbPages,
                    'lives'=>$lives]
                );
           

            return $this->twig->render('Home/navbar.html.twig');
        }
        return $this->twig->render('Home/navbar.html.twig');
    }
}
