<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminBooksController extends AbstractController
{

    /**
     * @Route("/admin/books", name="admin_list_books")
     */
public function booksRepository(BookRepository $bookRepository){
        $dernierBook = $bookRepository->findBy([],['id'=>'DESC'],4);

        return $this->render('Admin/admin_list_books.html.twig',[
            'dernierBook' => $dernierBook,
        ]);
}
}