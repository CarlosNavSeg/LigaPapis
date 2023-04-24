<?php

namespace App\Controller;

use App\Entity\Publicacion;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TablaPublicacionesController extends AbstractController
{
    #[Route('/galeria', name: 'app_galeria')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Publicacion::class);
        $publis = $repo->findAll();
        return $this->render('tabla_publicaciones/index.html.twig', [
            'controller_name' => 'TablaPublicacionesController',
            'publis' => $publis,
        ]);
    }
}
