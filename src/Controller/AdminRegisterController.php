<?php
/**
 * Created by PhpStorm.
 * User: nath
 * Date: 11/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\AdminRegisterManager;  // utilisation de la class AdminManager

class AdminRegisterController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function adminRegister()
    {

        $_SESSION=[];
        $adminError = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['username'] = addslashes($_POST['username']);
            $_POST['password'] = md5($_POST['password']);
            //echo  $_POST['password'];
            $admin = ['username' => $_POST['username'], 'password' => $_POST['password'],
                    'lastname'=> $_POST['lastname'],'firstname'=>$_POST['firstname']];
            // verif errors
            $adminError= [];

            if (!isset($admin['username']) || empty($admin['username'])) {
                $adminError['username']= "invalid username";
            }
            if (!isset($admin['password']) || empty($admin['password'])) {
                $adminError['password']= "invalid password";
            }
            
            if (empty($adminError)) {
                $adminManager = new AdminRegisterManager();
                echo'passe';
                $adminError['id'] = $adminManager->userAdminExist($admin['username'], $admin['password'], 'IN');
            }

            if (is_null($adminError['id'])) {
                $_SESSION['lastname'] = $admin['lastname'];
                $_SESSION['firstname'] = $admin['firstname'];
                header('Location: ../AdminAuthor/authorNotValidated');
                exit();
            }
        }

        return $this->twig->render('Admin/adminRegister.html.twig', ['adminError' => $adminError]);
    }

    public function adminAuthor()
    {
       
        // verif saisie author
        $errors=[];
        $values=[];
        $_SESSION['doujeviensAuthor']='createAuthor';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //$_POST['password'] = md5($_POST['password']);
            //$_POST['confpassword'] = md5($_POST['confpassword']);
            $admin = ['username' => $_POST['username'], 'password' => $_POST['password'],
                    'lastname'=> $_POST ['lastname'], 'firstname' => $_POST['firstname'],
                    'confpassword'=>$_POST['confpassword'],
                    'id'=>$_POST['id']];
            $result = $this->verifyAuthors($admin, 'create');
            $errors = $result['errors'];
            $values = $result['values'];
            
            if (empty($errors)) {
                $authorManager = new AdminRegisterManager();
                $errors['lastname'] = $authorManager->authorExist($admin['lastname'], $admin['firstname']);
               
                if (is_null($errors['lastname'])) {
                    // test username et password
                    $admin['password'] = md5($admin['password']);
                    //$_POST['confpassword'] = md5($_POST['confpassword']);
                    $adminManager = new AdminRegisterManager();
                    $errors['password'] = $adminManager->userAdminExist($admin['username'], $admin['password'], 'UP');
                    if (is_null($errors['password'])) {
                        // add author
                        $authorManager =  new AdminRegisterManager();

                        $id = $authorManager->authorInsert($values);
                        $_SESSION['authorId'] = $id;
                        $_SESSION['lastname'] = $admin['lastname'];
                        $_SESSION['firstname'] = $admin['firstname'];
                        
                        header('Location: ../AdminRegister/AdminRegister');
                        exit();
                    }
                }
            }
        }
        
        return $this->twig->render('Admin/adminAuthorForm.html.twig', 
                ['errors'=>$errors,'values'=>$values,'title2'=>'Create Author','session'=>$_SESSION]);
    }

    private function verifyAuthors($author, $quoi)
    {
        $value = [];
        $errors = [];

        $value = $author;
        $value['password'] = md5($value['password']);
        $value['id']=$this->verifInput($author["id"]);
        
        if ($quoi!='update') {
            if (!isset($author['username']) || empty($author['username'])) {
                $errors['username']= "username required";
            } else {
                $value["username"] = $this->verifInput($author["username"]);
            }
            if (!isset($author['password']) || empty($author['password'])) {
                $errors['password']= "password required";
            } else {
                if (! preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $author['password'])) {
                    if (strlen($author['password']) < 8) {
                        $errors['password'] = 'At least 8 characters are required';
                    } else {
                        $errors['password']= "invalid password";
                    }
                } else {
                    if (!isset($author['confpassword']) || empty($author['confpassword'])) {
                        $errors['confpassword']= "invalid confirmation password";
                    } else {
                    // comparaison password et confpassword
                        if (!($author['password'] === $author['confpassword'])) {
                            $errors['confpassword']="confirmation password not egal password !!";
                        }
                    }
                }
            }
        }

        if (!isset($author['lastname']) || empty($author['lastname'])) {
            $errors['lastname']= "invalid lastname";
        } else {
            $value["lastname"] = $this->verifInput($author["lastname"]);
        }
        if (!isset($author['firstname']) || empty($author['firstname'])) {
            $errors['firstname']= "invalid firstname";
        } else {
            $value["firstname"] = $this->verifInput($author["firstname"]);
        }
        return ['errors'=>$errors,'values'=>$value];
    }

    /**
     * Verify imputs from form
     *
     * @return string of cleaned input
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    private function verifInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

/**
     * update an existing author
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function authorUpdate(int $id)
    {
        // si POST, vérifier les entrées
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = ['username' => $_POST['username'], 'password' => $_POST['password'],
            'lastname'=> $_POST ['lastname'], 'firstname' => $_POST['firstname'],
            'confpassword'=>$_POST['confpassword'],
            'id'=>$_POST['id']];
            $result = $this->verifyAuthors($admin, "update");
            
            $errors = $result['errors'];
            $values = $result['values'];
            
            if (!empty($result['errors'])) {
                $_SESSION['doujeviensAuthor'] = "updateAuthor";

                return $this->twig->render(
                    '/Admin/adminAuthorForm.html.twig',
                    [   'errors'=>$errors,
                        'values'=>$values,
                       //'isValid'=>$this->isValid($errors, $values),
                        'title2'=>"Update Author",
                        'session'=>$_SESSION]
                );
            }
            $adminAuthorManager = new AdminRegisterManager();
            //$adminAuthorManager->edit($values);
            header('Location:/AdminAuthor/authorNotValidated');
        }

        $authorManager = new AdminRegisterManager();
        $author = $authorManager->selectOneById($id);
        $_SESSION['doujeviensAuthor'] = "updateAuthor";

        return $this->twig->render(
            '/Admin/adminAuthorForm.html.twig',
            [   'values' => $author,
                'title2'=>"Update Author",
                'session'=>$_SESSION]
        );
    }






    public function logout()
    {
        //session_start();
        session_destroy();
    
        
        header('location:../adminRegister/adminRegister');
        exit();
    }
}
