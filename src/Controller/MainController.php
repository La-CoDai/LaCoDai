<?php

namespace App\Controller;

use App\Repository\BrandsRepository;
use App\Repository\ProductsRepository;
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
}
