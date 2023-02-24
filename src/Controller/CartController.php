<?php

namespace App\Controller;

use App\Repository\BrandsRepository;
use App\Repository\CartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
