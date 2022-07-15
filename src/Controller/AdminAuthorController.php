<?php

namespace App\Controller;


use App\Form\AuthorType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;


class AdminAuthorController extends AbstractController
{
    /**
     * @Route("/admin/authors" ,name="admin_list_authors")
     */

    public function AuthorRepository(AuthorRepository $authorRepository ){
        $authors = $authorRepository->findall();

        return $this-> render('Admin/admin_list_autors.html.twig',[
                            'authors'=>$authors
        ]);
    }

    /**
     * @Route("/admin/author/{id}", name="admin_author_solo")
     */

    public function authoSolo(AuthorRepository $authorRepository,$id){

        $author=$authorRepository->find($id);
        return $this->render('Admin/admin_author_solo.html.twig',[
            'author'=>$author
        ]);
    }


    /**
     * @Route("/admin/uptdate/author/{id}", name="admin_update_author")
     */
    public function updateAuthor($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager, Request $request){// route OK
      $author=$authorRepository->find($id);//je recupère l'id de l'auteur
      $form =$this->createForm(AuthorType::class,$author);//je créé le formulaire pour la modif
      $form->handleRequest($request);//instance de la class request. Permet de recuperer les données modifiées
        if ($form->isSubmitted() && $form->isValid()){
          $entityManager->persist($author); //stock les données modifiées
          $entityManager->flush(); //envoie les données modifiées ver la BDD
      }
       return $this->render('Admin/admin_update_author.html.twig',[
                        "form"=>$form->createView()
        ]);

    }
}


