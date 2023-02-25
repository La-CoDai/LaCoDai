<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\Orderdetail;
use App\Entity\Products;
use App\Entity\User;
use App\Repository\BrandsRepository;
use App\Repository\CartRepository;
use App\Repository\CartTempRepository;
use App\Repository\OrderdetailRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * @Route("/order", name="show_order")
    */
    public function checkout(OrderRepository $order, CartRepository $repo, OrderdetailRepository $orderdetail, ProductsRepository $rePro, EntityManagerInterface $em): Response
    {
        //insert  to order
        $orderForm= new Order();
        //Get id user
        $user = $this->getUser();
        $data[]=[
            'id'=>$user->getId()
        ];
        $uid = $data[0]['id'];
        //Set id user for order table
        $orderForm->setUserorder($user); 
        //Get product id and quantity form Cart table
        $product = $repo->findCart($uid);

        $totalAll = 0;
        foreach ($product as $p) {
            $totalAll += $p['total'];
        }

        $orderForm->setTotal($totalAll);
        $orderForm->setDate(new \Datetime());
        $order->add($orderForm, true);
        
        // insert to orderdetail
        $oid = $order->orderdetail($uid)[0]['id'];
        $orderobject =$order->find($oid);

        
        // $carts_uid = $repo->findcart($uid);
        
        foreach ($product as $c){
            $orderdetailForm = new Orderdetail();
            $product = $c['id'];
            $productobject = $rePro->find($product);
            $quantity = $c['quantity'];
            $orderdetailForm->setOid($orderobject);
            $orderdetailForm->setPid($productobject);
            $orderdetailForm->setQuantity($quantity);
            $orderdetail->add($orderdetailForm,true);
                
        }

        $cartdelete = $repo->findAll();
        foreach ($cartdelete as $cartdel) {
            $em->remove($cartdel);
        }
        $em->flush();

        return $this->redirectToRoute('ordertemplate', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/ordertemplate", name="ordertemplate")
     */
    public function ordertemplate(BrandsRepository $reBra, OrderRepository $order, OrderdetailRepository $orderdetail, CartRepository $repo): Response
    {
        $user = $this->getUser();
        $data[]=[
            'id'=>$user->getId()
        ];
        $uid = $data[0]['id'];

        $oid = $order->orderdetail($uid)[0]['id'];

        $product = $repo->findCart($uid);

        $totalAll = 0;
        foreach ($product as $p) {
            $totalAll += $p['total'];
        }
        
        $ordertemplate1 = $orderdetail->showOrderByUserId($oid);
        $ordertemplate2 = $order->orderTemplate();
        $brand = $reBra->findAll();

        return $this->render('pay/order.html.twig', [
            'ordercart' => $ordertemplate1,
            'order' => $ordertemplate2,
            'brand' => $brand,
            'totalAll' => $totalAll
        ]);
    }

    /**
     * @Route("cart/delete/{procart}",name="delete_cart", requirements={"id"="\d+"})
     */
    
     public function deleteAction(CartRepository $reCart, Cart $c): Response
     {
        $reCart->remove($c,true);
        return $this->redirectToRoute('show_cart', [], Response::HTTP_SEE_OTHER);
     } 
}
