<?php

namespace App\Controller;
use App\Entity\Author;

use App\Form\AuthorType;
use ContainerXDkki8T\getDoctrine_QuerySqlCommandService;
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

    /**
     * @Route("/admin/delete/author/{id}" , name="delete_author")
     */
    public function deleteAuthor($id, EntityManagerInterface $entityManager,AuthorRepository $authorRepository){
        $author=$authorRepository->find($id); //on cherche par l'id
        $entityManager->remove($author);//on supprime
        $entityManager->flush();//on 'sauvegarde'
        $this->addFlash('succes', 'Auteur supprimé');//message de concirmation
        return $this->redirectToRoute('admin_list_authors');//on redirige
    }

    /**
     * @Route("/admin/insert/author", name="admin_insert_author")
     */
    public function createAuthor(EntityManagerInterface $entityManager, Request $request ){
       $author=new Author();

       $form= $this->createForm(AuthorType::class,$author);
       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
           $entityManager->persist($author);
           $entityManager->flush();
       }
       $this->addFlash('succes', 'auteur créé!');

         return $this->render('Admin/admin_insert_author.html.twig',[
           'form'=> $form->createView()
       ]);

    }

}


