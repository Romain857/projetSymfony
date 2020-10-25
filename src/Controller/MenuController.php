<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{

    public function menu()
    {
        return $this->render('menu/_menu.html.twig', [
            //'controller_name' => 'MenuController',
        ]);
    }
}
