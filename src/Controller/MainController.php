<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepageForm")
     */
    public function Homepage(): Response
    {
        // $products = $pro->findAllProduct_8item();
        // $brand = $bra->findAll();
        return $this->render('main/index.html.twig', [
            // 'products' => $products,
            // 'brand' => $brand
        ]);
    }

    /**
     * @Route("/aboutus", name="aboutusForm")
     */
    public function Aboutus(): Response
    {
        // $brand = $bra->findAll();
        return $this->render('main/aboutus.html.twig', [
            // 'brand' => $brand
        ]);
    }
}
