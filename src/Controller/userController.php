<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class userController extends AbstractController
{

    /**
     * @Route("/inscription", name="inscription")
     */
    public function insertUser(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher){

        $user= new User();
        $user->setRoles(['ROLES_USER']);

        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $plainPassword= $form->get('password')->getData();
            $hashedPassword=$userPasswordHasher->hashPassword($user, $plainPassword);

            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('succes', 'inscription réussie');

            return $this->redirectToRoute('home');
        }
        return $this->render('inscription.html.twig',[
                        'form'=>$form->createView()
        ]);
    }

}