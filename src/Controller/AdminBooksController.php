<?php

namespace App\Controller;
use App\Entity\Book;

use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminBooksController extends AbstractController
{
    // on crée la route pour la page d'accueil
        /**
         * @Route("/admin/books", name="admin_list_books")
         */
    public function booksRepository(BookRepository $bookRepository){
            $books = $bookRepository->findAll();//je veux chercher les livres existants
            return $this->render('Admin/admin_list_books.html.twig',[
                'books' => $books,
            ]);
    }

    //methode pour afficher les details d'un livre
        /**
         * @Route("/admin/book/{id}", name="admin_book")
         */
    public function bookSolo(BookRepository $bookRepository , $id){
        $book= $bookRepository->find($id);
        return $this->render('Admin/admin_solo_book.html.twig',[
            'book'=>$book
        ]);
    }

    // je créé la métode pour inserer des articles.
    //je créé la route pour l'url.
        /**
         * @Route("/admin/insert/book" , name="admin_insert_book")
         */
    public function insertBook(EntityManagerInterface $entityManager , Request $request)
    {
        $book = new Book();
    //avant toute chose, on créé le gabarit du form via cmd : php bon/console makde:form ( ce qui va créer le type BookType)
    // nous pouvons appeler le formulaire sur la page twig juse avec la ligne de commande (sur la page twig  {{ form(form) }}
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($book);
            $entityManager->flush();
            $this->addFlash('succes', 'Livre créé!');
        }
    return $this->render('Admin/admin_insert_book.html.twig', [
        'form' => $form->createView()
    ]);

    }


    /**
     * @Route("/admin/delete/book/{id}", name="delete_book")
     */
    public function deleteBook($id ,BookRepository $bookRepository,EntityManagerInterface $entityManager){
        $book= $bookRepository->find($id);
        $entityManager->remove($book); //on supprime le livre
        $entityManager->flush(); //on enregistre

        $this->addFlash('succes','livre supprimé');//on affiche le message

        return $this->redirectToRoute('admin_list_books'); //on retourne a la page des articles
    }


    /**
     * @Route("/admin/uptdate/book/{id}", name="update_book")
     */
    public function updateBook ($id, BookRepository $bookRepository, EntityManagerInterface $entityManager, Request $request)
    {
        $book = $bookRepository->find($id);

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($book);
            $entityManager->flush();
            $this->addFlash('success', 'Livre modifié');
        }
        return $this->render("Admin/update_book.html.twig",[
            'form'=>$form->createView()
        ]);

    }
}