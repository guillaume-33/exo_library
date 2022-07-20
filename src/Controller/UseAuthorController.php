<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UseAuthorController extends AbstractController
{
    /**
     * @Route("/authors" ,name="list_authors")
     */

    public function AuthorRepository(AuthorRepository $authorRepository ){
        $authors = $authorRepository->findall();

        return $this-> render('user_list_authors.html.twig',[
            'authors'=>$authors
        ]);
    }

    /**
     * @Route("/author/{id}", name="author_solo")
     */

    public function authoSolo(AuthorRepository $authorRepository,$id){

        $author=$authorRepository->find($id);
        return $this->render('user_author_solo.html.twig',[
            'author'=>$author
        ]);
    }

    /**
     * @Route("/author-search",name="search_author")
     */
    public function searchAuthor(Request $request, AuthorRepository $authorRepository){

        $search= $request->query->get('search');//recupere les info en GET

        //methode pour trouvé ce qu'on cherche via le mot tapé grace a 'searchByWord" Via "AuthorRepository"
        $authors=$authorRepository->searchByWord($search);

        return $this->render('search_author.html.twig',[
            'authors'=>$authors
        ]);// j'affiche le resultat sur la page
    }

}