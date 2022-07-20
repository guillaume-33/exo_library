<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="home")
     */
public function home(){
    return $this->render('home.html.twig');
}
    /**
     * @Route("/admin/",name="admin_home")
     */
    public function adminHome(){
        return $this->render('Admin/admin_home.html.twig');
    }
}