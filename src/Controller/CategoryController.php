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
    // public function index()
    // {
    //     // $itemManager = new ItemManager();
    //     // $items = $itemManager->selectAll();

    //     return $this->twig->render('Category/category.html.twig');
    // }


    // *
    //  * Display item informations specified by $id
    //  *
    //  * @param int $id
    //  * @return string
    //  * @throws \Twig\Error\LoaderError
    //  * @throws \Twig\Error\RuntimeError
    //  * @throws \Twig\Error\SyntaxError
     
    public function show()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAll();

        return $this->twig->render(
            'Category/category_add.html.twig',
            ['categoryAll'=> $categories,
            'Btn' => 'Ajouter',
            'method'=>'add',
            'title_page' => ' Liste des catégories']
        );
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


//     *
//      * Display item creation page
//      *
//      * @return string
//      * @throws \Twig\Error\LoaderError
//      * @throws \Twig\Error\RuntimeError
//      * @throws \Twig\Error\SyntaxError
     
    public function add()
    {


      
            echo "string";
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
        $categoryManager = new CategoryManager();
        $categoryManager->delete($id);
        header('Location:/category/show');
    }
}
