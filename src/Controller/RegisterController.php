<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\BrandsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="registerForm")
     */
    public function registerForm(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, BrandsRepository $reBra): Response
    {
        $brand = $reBra -> findAll();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);   
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();

            //send email (later)
            //....

            return $this->redirectToRoute('loginForm');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'brand' => $brand
        ]);
    }
}
