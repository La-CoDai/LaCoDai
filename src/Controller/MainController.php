<?php

namespace App\Controller;

use App\Repository\BrandsRepository;
use App\Repository\ProductsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepageForm")
     */
    public function Homepage(ProductsRepository $pro, BrandsRepository $bra): Response
    {
        $products = $pro->findAllProduct_8item();
        $brand = $bra->findAll();
        return $this->render('main/index.html.twig', [
            'products' => $products,
            'brand' => $brand
        ]);
    }

        /**
     * @Route("/aboutus", name="aboutusForm")
     */
    public function Aboutus(BrandsRepository $bra): Response
    {
        $brand = $bra->findAll();
        return $this->render('main/aboutus.html.twig', [
            'brand' => $brand
        ]);
    }

    /**
     * @Route("/contact", name="contactForm")
     */
    public function Contact(BrandsRepository $bra): Response
    {
        $brand = $bra->findAll();
        return $this->render('main/contact.html.twig', [
            'brand' => $brand
        ]);
    }

    /**
     * @Route("/profile", name="profileForm")
     */
    public function Profile(BrandsRepository $reBra, UserRepository $reUser): Response
    {
        $user = $this->getUser();
        $data[]=[
            'id'=>$user->getId()
        ];
        $uid = $data[0]['id'];
        $brand = $reBra->findAll();
        $user = $reUser->listprofile($uid);
        return $this->render('main/profile.html.twig', [
            'user' => $user,
            'brand' => $brand
        ]);
    }

    /**
     * @Route("/profile/update/{id}", name="profileUp")
     */
    public function ProfileUp(BrandsRepository $reBra, UserRepository $reUser, Request $req, User $u): Response
    {
        $name = $req->query->get('name');
        $address = $req->query->get('address');
        $phone = $req->query->get('phone');
        $u->setName($name);
        $u->setAddress($address);
        $u->setPhone($phone);
        $reUser->add($u,true);
        return $this->redirectToRoute('profileForm', [], Response::HTTP_SEE_OTHER);
    }
}
