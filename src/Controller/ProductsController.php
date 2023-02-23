<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\BrandsRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/product/detail/{id}", name="detail_product")
     */
    public function showDetailProduct(Products $pro, ProductsRepository $repo, BrandsRepository $bra): Response
    {
        $brid = $pro->getBrand();
        $brand = $repo->findRelativeProduct($brid);
        $br = $bra->findAll();
        return $this->render('product/detail.html.twig', [
            'product'=>$pro,
            'brid'=>$brand,
            'brand'=>$br
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
