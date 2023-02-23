<?php

namespace App\Controller;

use App\Entity\Brands;
use App\Repository\BrandsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("admin/brand/add", name="add_brand")
     */
    public function addBrand(BrandsRepository $repo, Request $req): Response
    {
        $a = new Brands();
        $form = $this->createForm(BrandType::class,$a);
        $form->handleRequest($req);
        if ($form->isSubmitted()&&$form->isValid()) {
            $repo->add($a,true);
            return $this->redirectToRoute('show_brand', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('admin_brand/add.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
