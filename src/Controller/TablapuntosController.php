<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TablapuntosController extends AbstractController
{
    #[Route('/tablapuntos', name: 'app_tablapuntos')]
    public function index(): Response
    {
        return $this->render('tablapuntos/index.html.twig', [
            'controller_name' => 'TablapuntosController',
        ]);
    }
}
