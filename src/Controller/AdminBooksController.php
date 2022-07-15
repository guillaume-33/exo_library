<?php

namespace App\Controller;

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

// je créé la métode pour inserer des articles.
//je créé la route pour l'url.
    /**
     * @Route("/admin/insert/book" , name="admin_insert_book")
     */
public function insertBook(EntityManagerInterface $entityManager , Request $request)
{
   dd('test');

}
}