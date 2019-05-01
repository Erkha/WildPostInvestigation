<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\CategoryManager;
use App\Model\AdminArticleManager;

/**
 * Class ItemController
 *
 */
class CategoryController extends AbstractController
{


    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

     
    public function show($deleteNo = false)
    {
        if (!empty($_SESSION)) {
            $categoryManager = new CategoryManager();
            $categories = $categoryManager->selectAll();

            return $this->twig->render(
                'Category/category_add.html.twig',
                ['categoryAll'=> $categories,
                'Btn' => 'Ajouter',
                'method'=>'add',
                'title_page' => 'Catégorie',
                'deleteNo' =>$deleteNo]
            );
        } else {
            header("location:../adminRegister/adminRegister");
            exit();
        }
    }


//     /**
//      * Display item edition page specified by $id
//      *
//      * @param int $id
//      * @return string
//      * @throws \Twig\Error\LoaderError
//      * @throws \Twig\Error\RuntimeError
//      * @throws \Twig\Error\SyntaxError
    
    public function edit(int $id): string
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneById($id);
        $categories = $categoryManager -> selectAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category['name'] = $_POST['name'];
            $categoryManager->update($category);
            header('Location: /Category/show');
        }
        return $this->twig->render(
            'Category/category_add.html.twig',
            ['category' => $category,
            'categoryAll'=> $categories,
            'title_page' => 'Editer catégorie',
            'method'=>'edit/'.$category['id'],
            'values' => $category,
            'Btn' => 'Editer']
        );
    }

// *
//      * Display item creation page
//      *
//      * @return string
//      * @throws \Twig\Error\LoaderError
//      * @throws \Twig\Error\RuntimeError
//      * @throws \Twig\Error\SyntaxError
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryManager = new CategoryManager();
            $addCat = ['name' => $_POST['name']];
            $idCat = $categoryManager -> insert($addCat);
            header('Location:/category/show');
        }
        return $this->twig->render('Category/category_add.html.twig');
    }


    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $articleManager = new AdminArticleManager();
        $nbArticles = $articleManager->checkArticlesOnCategory($id) ;
        if ($nbArticles['nb'] == 0) {
            $categoryManager = new CategoryManager();
            $categoryManager->delete($id);
            header('Location:/category/show');
        } else {
            header('Location:/category/show/deleteNo=true');
        }
    }
}
