<?php
/**
 * Created by vsc.
 * User: nathalie
 * Date: 25/04/19
 * Time: 10:15
 */

namespace App\Controller;

use App\Model\AdminRegisterManager;  // utilisation de la class AdminManager

class AdminAuthorController extends AbstractController
{

    /**
     * Display authors listing for admin
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        if (!empty($_SESSION)) {
            $authorManager = new AdminRegisterManager();
            $authors = $authorManager->selectAll();

            return $this->twig->render(
                'Admin/adminAuthorList.html.twig',
                ['authors' => $authors]
            );
        } else {
            header("location:../adminRegister/adminRegister");
            exit();
        }
    }

    public function authorNotValidated()
    {
        $authorManager = new AdminRegisterManager();
        
        $authors = $authorManager->authorListNotValidated();

        return $this->twig->render(
            'Admin/adminAuthorList.html.twig',
            ['authors' => $authors]
        );
    }
}
