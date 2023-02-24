<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAccountController extends AbstractController
{
    /**
     * @Route("admin/account", name="show_account")
     */
    public function showAccount(UserRepository $repo): Response
    {
        $acc = $repo->findAll();
        return $this->render('admin_account/list.html.twig', [
            'account' => $acc
        ]);
    }
}
