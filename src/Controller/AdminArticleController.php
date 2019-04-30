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
use App\Model\AdminRegisterManager;

/**
 * Class ItemController
 *
 */
class AdminArticleController extends AbstractController
{
    /**
     * Display article listing for admin
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index(int $page = 1)
    {
        $articleManager = new AdminArticleManager();
        $articles = $articleManager->selectPagedArticlesWithJoin($page);
        $nbArticles = $articleManager->countArticles();
        $nbPages = ceil($nbArticles['nb']/5);

        return $this->twig->render(
            'AdminArticle/AdminArticleList.html.twig',
            ['articles' => $articles, 'pages'=> $nbPages ]
        );
    }

    /**
     * Handle article deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $adminArticleManager = new AdminArticleManager();
        $adminArticleManager->delete($id);
        header('Location:/adminArticle/index');
    }

    /**
     * Create a new article
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $CategoryManager = new CategoryManager();
        $categories = $CategoryManager->selectAll();
        $AdminAuthorManager = new AdminRegisterManager();
        $authors = $AdminAuthorManager->selectAll();

        /** Verification ajout article **/
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->verifyInputs($_POST);
            $errors = $result['errors'];
            $values = $result['values'];
            if (!empty($_FILES)) {
                if ($_FILES['fileU']['size']<1000000 && $_FILES['fileU']['size']>0) {
                    $uploadDir = 'assets/images/';
                    $extension = explode('/', $_FILES['fileU']['type']);
                    $values['imageName'] = $uploadDir . "image".microtime();
                    $values['imageName']=str_replace(
                        ".",
                        "",
                        str_replace(" ", "", $values['imageName'])
                    ).".".$extension[1];
                    move_uploaded_file($_FILES['fileU']['tmp_name'], $values['imageName']);
                }
            }
            if (!empty($result['errors'])) {
                return $this->twig->render(
                    'AdminArticle/adminArticleForm.html.twig',
                    [   'errors'=>$errors,
                        'values'=>$values,
                        'isValid'=>$this->isValid($errors, $values),
                        'categories'=>$categories,
                        'authors' =>$authors,
                        'title2'=>"Nouvel Article"]
                );
            }
            $adminArticleManager = new AdminArticleManager();
            $id = $adminArticleManager->insert($values);
            header('Location:/adminArticle/index');
        }
        return $this->twig->render(
            'AdminArticle/adminArticleForm.html.twig',
            ['categories'=>$categories,
             'authors' =>$authors,
            'values'=>['articleDate'=>date("Y-m-j")],
            'title2'=>"NouvelArticle"]
        );
    }

    /**
     * update an existing article
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function update(int $id)
    {
        $articleManager = new AdminArticleManager();
        $article = $articleManager->selectOneById($id);
        $CategoryManager = new CategoryManager();
        $categories = $CategoryManager->selectAll();
        $AdminAuthorManager = new AdminRegisterManager();
        $authors = $AdminAuthorManager->selectAll();

        // si POST, vérifier les entrées
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->verifyInputs($_POST);
            $errors = $result['errors'];
            $values = $result['values'];
            if (!empty($_POST['imageName'])) { //récupère la photo initiale
                $values['imageName'] = $_POST['imageName'];
            }
            if (!empty($_FILES)) { // gestion de la modif de photos
                if ($_FILES['fileU']['size']<1000000 && $_FILES['fileU'][ 'size']>0) {
                    $uploadDir = 'assets/images/';
                    $extension = explode('/', $_FILES['fileU']['type']);
                    $values['imageName'] = $uploadDir . "image".microtime();
                    $values['imageName']=str_replace(
                        ".",
                        "",
                        str_replace(" ", "", $values['imageName'])
                    ).".".$extension[1];
                    move_uploaded_file($_FILES['fileU']['tmp_name'], $values['imageName']);
                }
            }
            if (!empty($result['errors'])) {
                return $this->twig->render(
                    'AdminArticle/adminArticleForm.html.twig',
                    [   'errors'=>$errors,
                        'values'=>$values,
                        'isValid'=>$this->isValid($errors, $values),
                        'authors' =>$authors,
                        'categories'=>$categories,
                        'title2'=>"Mise à jour de l'article"]
                );
            }
            $adminArticleManager = new AdminArticleManager();
            $adminArticleManager->edit($values);
            header('Location:/adminArticle/index');
        }

        return $this->twig->render(
            'AdminArticle/adminArticleForm.html.twig',
            [   'values' => $article,
                'categories'=>$categories,
                'authors' =>$authors,
                'title2'=>"Mise à jour de l'article"]
        );
    }


    private function isValid($errors, $values)
    {
        $isValid=[];
        
        foreach ($errors as $key => $value) {
            $isValid[$key]="is-invalid";
        }
        foreach ($values as $key => $value) {
            if (!array_key_exists($key, $errors)) {
                $isValid[$key]="is-valid";
            }
        }
        return $isValid;
    }

    /**
     *
     */
    private function verifyInputs($inputData)
    {
            $value = [];
            $error = [];
        $value['id']=$this->testInput($inputData["id"]);
        
        /** Verification title **/
        if (empty($inputData["title"])) {
            $error['title'] = 'Titre obligatoire';
        } elseif (strlen($inputData["title"])>100) {
            $value["title"] = $this->testInput($inputData["title"]);
            $error['title'] = 'le titre doit faire moins de 100 caractères';
        } else {
            $value["title"] = $this->testInput($inputData["title"]);
        }

        /** Verification date **/
        if (empty($inputData["articleDate"])) {
            $error['articleDate'] = 'Add date';
        } else {
             $value["articleDate"] = $this->testInput($inputData["articleDate"]);
        }
        /** Verification author **/
        if (empty($inputData["authorId"])) {
            $error['authorId'] = 'Add author';
        } elseif (strlen($inputData["authorId"])>50) {
            $value["authorId"] = $this->testInput($inputData["authorId"]);
            $error['authorId'] = 'le nom de l\'auteur doit faire moins de 50 caracteres' ;
        } else {
             $value["authorId"] = $this->testInput($inputData["authorId"]);
        }
        /** Verification Category **/
        if (empty($inputData["categoryId"])) {
            $error['categoryId'] = 'Select Category';
        } elseif (strlen($inputData["categoryId"])>50) {
            $value["categoryId"] = $this->testInput($inputData["categoryId"]);
            $error['categoryId'] = 'la catégorie doit faire moins de 50 caractères';
        } else {
             $value["categoryId"] = $this->testInput($inputData["categoryId"]);
        }
        
        /** Verification content **/
        if (empty($inputData["content"])) {
            $error['content'] = 'Add short text';
        } else {
             $value["content"] = $inputData["content"];
        }
        
        /** Verification tag **/
        if (strlen($inputData["tag"])>50) {
            $value["tag"] = $this->testInput($inputData["tag"]);
            $error['tag'] = 'les tags doivent faire moins de 50 caractères';
        } else {
             $value["tag"] = $this->testInput($inputData["tag"]);
        }

        /** Verification topArt **/
        if (isset($inputData["topArt"])) {
            $value["topArt"] = true;
            $adminArticleManager = new AdminArticleManager();
            $adminArticleManager->topArtEmpty();
        } else {
             $value["topArt"] = false;
        }

        /** Verification published **/
        /** Verification topArt **/
        if (isset($inputData["published"])) {
            $value["published"] = true;
        } else {
             $value["published"] = false;
        }

            return ['errors'=>$error,'values'=>$value];
    }

    /**
     * Verify imputs from form
     *
     * @return string of cleaned input
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    private function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
