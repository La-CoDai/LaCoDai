<?php

namespace App\Controller;

use App\Repository\BrandsRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="app_products")
     */
    public function index(): Response
    {
        return $this->render('products/index.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }
        /**
     * @Route("/product/brand/{id}", name="product_brand")
     */
    public function showProductBrand(ProductsRepository $rePro, BrandsRepository $reBra, int $id): Response
    {
        $brand = $reBra->findOneBrand($id);
        $br = $reBra->findAll();
        $pro = $rePro->findProductBrand($id);
        return $this->render('product/findBrand.html.twig', [
            'brand' => $br,
            'bra' => $brand,
            'product' => $pro
        ]);
    }
}
