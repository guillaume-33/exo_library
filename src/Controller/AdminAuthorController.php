<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;

class AdminAuthorController extends AbstractController
{
    /**
     * @Route("/admin/authors" ,name="admin_list_authors")
     */

    public function AuthorRepository(AuthorRepository $authorRepository, ){
        $authors = $authorRepository->findall();

        return $this-> render('Admin/admin_list_autors.html.twig',[
                            'authors'=>$authors
        ]);
    }

}