<?php

namespace App\Controller;

use App\Entity\Papi;
use App\Repository\PapiRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TablapuntosController extends AbstractController
{
    #[Route('/tablapuntos', name: 'app_tablapuntos')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Papi::class);
        $papis = $repo->findAll();

        return $this->render('tablapuntos/index.html.twig', [
            'papis' => $papis
        ]);
    }
}
