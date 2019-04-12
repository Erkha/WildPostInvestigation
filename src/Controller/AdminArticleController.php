<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\AdminArticleManager;

class AdminArticleController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        $articleManager = new AdminArticleManager();
        $articles = $articleManager->selectAll();

        return $this->twig->render('AdminArticle/AdminArticleList.html.twig', ['articles' => $articles]);
    }
    
    private function testInput($data)
    {
     
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



    public function add()
    {
            $value = [];
        /** Verification ajout article **/
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        /** Verification title **/
            if (empty($_POST["title"])) {
                $error['title'] = 'Add title';
            } else {
                 $value["title"] = $this->testInput($_POST["title"]);
            }
        /** Verification date **/
            if (empty($_POST["date"])) {
                $error['date'] = 'Add date';
            } else {
                 $value["date"] = $this->testInput($_POST["date"]);
            }
        /** Verification author **/
            if (empty($_POST["author"])) {
                $error['author'] = 'Add author';
            } else {
                 $value["author"] = $this->testInput($_POST["author"]);
            }
        /** Verification Category **/
            if (empty($_POST["selectCat"])) {
                $error['selectCat'] = 'Select Category';
            } else {
                 $value["selectCat"] = $this->testInput($_POST["selectCat"]);
            }
        /** Verification Short text **/
            if (empty($_POST["shortText"])) {
                $error['shortText'] = 'Add short text';
            } else {
                 $value["shortText"] = $this->testInput($_POST["shortText"]);
            }

                    /** Verification Short text **/
            if (empty($_POST["content"])) {
                $error['content'] = 'Add short text';
            } else {
                 $value["content"] = $this->testInput($_POST["content"]);
            }
        /** Verification Short text **/
            // if (empty($_POST["upload"])){
            //     $error['upload'] = 'Add image';
            // }else{
            //      $value["upload"] = $this->testInput($_POST["upload"]);
            // }
        /** Verification tag **/
            if (empty($_POST["tag"])) {
                $error['tag'] = 'Add tag';
            } else {
                 $value["tag"] = $this->testInput($_POST["tag"]);
            }

            if (!empty($error)) {
                return $this->twig->render(
                    'AdminArticle/adminArticle.html.twig',
                    ['error'=> $error, 'value' => $value]
                );
            }


            $itemManager = new AdminArticleManager();

            $id = $itemManager->insert($value);
            //header('Location:/item/show/' . $id);
        }

        return $this->twig->render('AdminArticle/adminArticle.html.twig');
    }
}