<?php

namespace App\Controller;

use App\Entity\Orderdetail;
use App\Repository\BrandsRepository;
use App\Repository\OrderdetailRepository;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/myorder", name="my_order")
     */
    public function myorder(BrandsRepository $reBra, OrderRepository $reOrd): Response
    {
        $user = $this->getUser();
        $data[]=[
            'id'=>$user->getId()
        ];
        $uid = $data[0]['id'];
        $order = $reOrd->showOrderByUserId($uid);
        $brand = $reBra->findAll();
        return $this->render('order/order.html.twig', [
            'order' => $order,
            'brand' => $brand
        ]);
    }

    /**
     * @Route("/myorder/myorderdetail/{oid}", name="my_orderdetail")
     */
    public function myorderdetail(BrandsRepository $reBra, OrderdetailRepository $reOrdetail, Orderdetail $od): Response
    {
        $oid = $od->getOid();
        $orderdetail = $reOrdetail->showOrderByUserId($oid);
        $id = $orderdetail[0]['id'];
        $brand = $reBra->findAll();
        return $this->render('order/orderdetail.html.twig', [
            'id' => $id,
            'orderdetail' => $orderdetail,
            'brand' => $brand
        ]);
    }
}
