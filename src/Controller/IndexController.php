<?php

namespace App\Controller;

use App\Entity\Papi;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Papi::class);
        $papis = $repo->findAll();

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'papis' => $papis
        ]);
    }
}
