<?php

namespace App\Controller;

use App\Entity\Brands;
use App\Repository\BrandsRepository;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
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

    /**
     * @Route("admin/brand/edit/{id}", name="edit_brand")
     */
    public function editBrand(BrandsRepository $repo, Request $req, Brands $b): Response
    {
        $form = $this->createForm(BrandType::class,$b);

        $form->handleRequest($req);
        if ($form->isSubmitted()&&$form->isValid()) {
            $repo->add($b,true);
            return $this->redirectToRoute('show_brand', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('admin_brand/edit.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("admin/brand/delete/{id}",name="delete_brand", requirements={"id"="\d+"})
     */
    
     public function deleteAction(BrandsRepository $repo, Brands $b): Response
     {
        try {
            $repo->remove($b,true);
        } catch (ForeignKeyConstraintViolationException $th) {
            return $this->redirectToRoute('errForm', [], Response::HTTP_SEE_OTHER);
        }
         return $this->redirectToRoute('show_brand', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/err", name="errForm")
     */
    public function FunctionName(): Response
    {
        return $this->render('error.html.twig', []);
    }
}
