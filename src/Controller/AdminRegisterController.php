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
        $adminError = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['username'] = addslashes($_POST['username']);
            //$_POST['password'] = md5($_POST['password']);
            $admin = [
                'username' => $_POST['username'],
                'password' => $_POST['password'] 
            ];     
            // verif errors
            $errors= [];

            if (!isset($admin['username']) || empty($admin['username'])) {
                $errors['username']= "invalid username";
            }
            else{
                if (!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/",$admin['username'])){
                    $errors['username']= "Only letters and numbers allowed";
                }
            }
            if (!isset($admin['password']) || empty($admin['password'])) {
                $errors['password']= "invalid password";
            } 
            else{
                if (!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$admin['password'])){
                    $errors['password']= "UpperCase, LowerCase, Number/SpecialChar and min 8 Chars";
                }
            }
            $adminError = null;
            if( empty($errors)) {
                $adminManager = new AdminRegisterManager();
                $adminError = $adminManager->userAdminExist($admin['username'], $admin['password']);
                
            }
            if (empty($adminError)) {
                echo "good";
                //header('Location: ');
                //exit();
            }

        }

        return $this->twig->render('Admin/adminRegister.html.twig', ['adminError' => $adminError]);
    }
}