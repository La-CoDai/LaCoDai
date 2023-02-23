<?php

namespace App\Controller;

use App\Repository\BrandsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBrandController extends AbstractController
{
    /**
     * @Route("admin/brand", name="show_brand")
     */
    public function showBrand(BrandsRepository $repo): Response
    {
        $brand = $repo->findAll();
        return $this->render('admin_brand/list.html.twig', [
            'brand' => $brand
        ]);
    }
}
