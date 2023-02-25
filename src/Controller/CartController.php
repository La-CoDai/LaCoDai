<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Products;
use App\Repository\BrandsRepository;
use App\Repository\CartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="show_cart")
     */
    public function cart(CartRepository $reCart, BrandsRepository $reBra): Response
    {
        // $cart = $reCart->findAll();
        $user = $this->getUser();
        $data[]=[
            'id'=>$user->getId()
        ];
        $uid = $data[0]['id']; 
        $product = $reCart->showCartByUserId($uid);
        $totalAll = 0;
        foreach ($product as $p) {
            $totalAll += $p['total'];
        }
        $brand = $reBra->findAll();
        // return $this->json($product);
        return $this->render('cart/cart.html.twig', [
            'totalAll' => $totalAll,
            'product' => $product,
            'brand' => $brand
        ]);
    }

    /**
     * @Route("/addcart/{id}", name="add_cart")
     */
    public function addcart(Products $pro, CartRepository $reCart, Request $req): Response
    {
        $quantity_temp = $req->query->get('quantity');
        if ($quantity_temp > 1) {
            $quantityNew = $quantity_temp;
        }else {
            $quantityNew = 1;
        }
        
        $user = $this->getUser();
        $data[]=[
            'id'=>$user->getId()
        ];
        $uid = $data[0]['id'];

        $cart = $reCart->findBy([
            'procart'=>$pro->getId(),
            'usercart'=>$uid
        ]);

        if (count($cart) == 0) {
            $c = new Cart();
            $c->setProcart($pro);
            $c->setQuantity($quantityNew);
            $c->setUsercart($user);
        }
        else {   
           $c = $reCart->find($cart[0]->getId()); // a Cart 
           $quantityOld = $c->getQuantity();
           $quantityNew = $quantityOld + $quantityNew;
           $c->setquantity($quantityNew);
       }
        $reCart->add($c,true);
        return $this->redirectToRoute('show_cart', [], Response::HTTP_SEE_OTHER);
    }
}
