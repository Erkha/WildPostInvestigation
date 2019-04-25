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

    public function index()
    {
        $articleManager = new AdminArticleManager();
        $articles = $articleManager->selectAll();

        return $this->twig->render(
            'AdminArticle/AdminArticleList.html.twig',
            ['articles' => $articles,
            'categories'=>self::CATEGORIES]
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
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        /** Verification ajout article **/
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->verifyInputs($_POST);
            $errors = $result['errors'];
            $values = $result['values'];

            if (!empty($_FILES)) {
                if ($_FILES['fileU']['size']<1000000) {
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
                        'categories'=>self::CATEGORIES,
                        'title2'=>"Nouvel Article"]
                );
            }

            $adminArticleManager = new AdminArticleManager();

            $id = $adminArticleManager->insert($values);
            
            header('Location:/adminArticle/index');
        }

        return $this->twig->render(
            'AdminArticle/adminArticleForm.html.twig',
            ['categories'=>self::CATEGORIES,
            'values'=>['articleDate'=>date("Y-m-j")],
            'title2'=>"NouvelArticle"]
        );
    }
    
    private function testInput($data)
    {
        // si POST, vérifier les entrées
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->verifyInputs($_POST);
            $errors = $result['errors'];
            $values = $result['values'];
            if (!empty($_FILES)) {
                if ($_FILES['fileU']['size']<1000000) {
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
                        'categories'=>self::CATEGORIES,
                        'title2'=>"Mise à jour de l'article"]
                );
            }
            $adminArticleManager = new AdminArticleManager();
            $adminArticleManager->edit($values);
            header('Location:/adminArticle/index');
        }

        $articleManager = new AdminArticleManager();
        $article = $articleManager->selectOneById($id);
        return $this->twig->render(
            'AdminArticle/adminArticleForm.html.twig',
            [   'values' => $article,
                'categories'=>self::CATEGORIES,
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
        /** Verification ajout article **/
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


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
        if (empty($inputData["author"])) {
            $error['author'] = 'Add author';
        } elseif (strlen($inputData["author"])>50) {
            $value["author"] = $this->testInput($inputData["author"]);
            $error['author'] = 'le nom de l\'auteur doit faire moins de 50 caracteres' ;
        } else {
             $value["author"] = $this->testInput($inputData["author"]);
        }
        /** Verification Category **/
        if (empty($inputData["category"])) {
            $error['category'] = 'Select Category';
        } elseif (strlen($inputData["category"])>50) {
            $value["category"] = $this->testInput($inputData["category"]);
            $error['category'] = 'la catégorie doit faire moins de 50 caractères';
        } else {
             $value["category"] = $this->testInput($inputData["category"]);
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

            $id = $itemManager->insert($value);
            //header('Location:/item/show/' . $id);
        }

        return $this->twig->render('AdminArticle/adminArticle.html.twig');
    }
}
