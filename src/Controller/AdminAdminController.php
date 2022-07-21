<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminAdminController extends AbstractController
{
    /**
     * @Route("/admin/admins" , name="admin_list_admins")
     */

public function listAdmin(UserRepository $userRepository){
    $admins=$userRepository->findAll(); //je cherche tout les users de la BDD
    return $this->render('Admin/admin_admins.html.twig',[
            'admins'=> $admins]);// j'affiche les admins
}


    /**
     * @Route("/admin/insert/admin", name="admin_insert_admin")
     */
public function AddAdmin(Request $request,EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher){
    $user = new User(); // je créé un nouveau user
    $user->setRoles(['ROLES_ADMIN']);//je defini son roles parmi ceux qui sont dispo ( admin a automatiquement les droits inferieurs

    $form= $this->createForm(UserType::class,$user);//je recupere le gabarit du form depuis UserType
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){

        $plainPassword = $form->get('password')->getData();//je recupere le mot de passe 'en dur(tapé)'
        $hashedPassword = $userPasswordHasher->hashPassword($user,$plainPassword);//je crypte le password

        $user->setPassword($hashedPassword);

        $entityManager->persist($user); //'j'enregistre' l'admin
        $entityManager->flush();//je l'envoie a la BDD

        $this->addFlash('success', 'user créé');// j'affiche un message de succes

        return$this->redirectToRoute('admin_list_admins');// j'envoie sur la page de création d'admins
    }
    return $this->render('Admin/admin_insert_admin.html.twig',[
        'form'=>$form->createView() //j'envoie le formulaire sur la page
    ]);

}
}