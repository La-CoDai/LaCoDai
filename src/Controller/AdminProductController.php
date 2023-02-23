<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    /**
     * @Route("admin/product", name="show_product")
     */
    public function showProduct(ProductsRepository $repo): Response
    {
        $product = $repo->findAll();
        return $this->render('admin_product/list.html.twig', [
            'product' => $product
        ]);
    }
}
