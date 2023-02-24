<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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

        /**
     * @Route("admin/product/add", name="add_product")
     */
    public function createAction(Request $req, SluggerInterface $slugger, ProductsRepository $repo): Response
    {
        
        $p = new Products();
        $form = $this->createForm(ProductType::class, $p);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $p->setPimg($newFilename);
            }
            $repo->add($p,true);
            return $this->redirectToRoute('show_product', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("admin_product/add.html.twig",[
            'form' => $form->createView()
        ]);
    }

    
    public function uploadImage($imgFile, SluggerInterface $slugger): ?string{
        $originalFilename = pathinfo($imgFile->getClientOrigicnalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$imgFile->guessExtension();
        try {
            $imgFile->move(
                $this->getParameter('image_dir'),
                $newFilename
            );
        } catch (FileException $e) {
            echo $e;
        }
        return $newFilename;
    }
}
