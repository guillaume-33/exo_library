<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class userBooksController extends AbstractController
{
    // on crée la route pour la page d'accueil
    /**
     * @Route("/books", name="list_books")
     */
    public function listBook(BookRepository $bookRepository){
        $books = $bookRepository->findAll();//je veux chercher les livres existants
        return $this->render('list_books.html.twig',[
            'books' => $books,
        ]);
    }
    //methode pour afficher les details d'un livre
    /**
     * @Route("/book/{id}", name="solo_book")
     */
    public function bookSolo(BookRepository $bookRepository , $id){
        $book= $bookRepository->find($id);
        return $this->render('solo_book.html.twig',[
            'book'=>$book
        ]);
    }
}