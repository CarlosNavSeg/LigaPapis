<?php

namespace App\Controller;

use App\Entity\EntradasTabla;
use App\Form\EntradaTablaType;
use App\Repository\EntradasTablaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntradaTablaFormController extends AbstractController
{
    #[Route('/entrada/tabla/form', name: 'app_entrada_tabla_form')]
    public function index(ManagerRegistry $doctrine, Request $request, EntradasTablaRepository $entradasTabla): Response
    {
        $entradaTabla = new EntradasTabla();

        $usuario = $this->getUser();
        $entradas = $entradasTabla->findEntradasByPapi($usuario->getPapi()->getId());

        $form = $this->createForm(EntradaTablaType::class, $entradaTabla);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entradaTabla->setFecha(new \DateTime);
            $papiFinder = $this->getUser()->getPapi();
            $entradaTabla->setPapi($papiFinder);
            $papiFinder->setPuntosTotales($papiFinder->getPuntosTotales() + $form->getData()->getPuntos());
            $entityManager = $doctrine->getManager();
            $entityManager->persist($entradaTabla);
            $entityManager->flush();
            return $this->redirectToRoute('app_entrada_tabla_form');
        }

        return $this->render('/entrada_tabla_form/index.html.twig',[
            'formulario' => $form->createView(),
            'entradas' => $entradas,
        ]);
    }
}
