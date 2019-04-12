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
            $_POST['password'] = md5($_POST['password']);
            $admin = ['username' => $_POST['username'], 'password' => $_POST['password']];
            // verif errors
            $errors= [];

            if (!isset($admin['username']) || empty($admin['username'])) {
                $errors['username']= "invalid username";
            } 
            if (!isset($admin['password']) || empty($admin['password'])) {
                $errors['password']= "invalid password";
            } 
            $adminError = null;
            if (empty($errors)) {
                $adminManager = new AdminRegisterManager();
                $adminError = $adminManager->userAdminExist($admin['username'], $admin['password']);
            }
            if (empty($adminError) ) {
                echo "good";
                //header('Location: ');
                //exit();
            }
        }

        return $this->twig->render('Admin/adminRegister.html.twig', ['adminError' => $adminError]);
    }
}
