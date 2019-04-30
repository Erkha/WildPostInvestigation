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
    

    public function searchArticles()
    {
       
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            if (isset($_POST['search'])) {
                $critere = $_POST['search'];
                $articleManager = new AdminArticleManager();
                
                $articles = $articleManager->searchArticles($critere);
                $categoryManager = new CategoryManager();
                $categories = $categoryManager->selectAll();
            
                return $this->twig->render('Search/search.html.twig', 
                            ['articles' => $articles,'categoryAll'=> $categories]);
            }

            return $this->twig->render('Home/navbar.html.twig');
        }
        return $this->twig->render('Home/navbar.html.twig');
    }
}
