<?php

namespace App\Controller;

use App\Entity\Publicacion;
use App\Form\PublicacionType;
use App\Repository\PublicacionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PublicacionController extends AbstractController
{
    #[Route('/publicacion', name: 'app_publicacion')]
    public function crearPubli(ManagerRegistry $doctrine, Request $request, PublicacionRepository $publicacion, SluggerInterface $slugger): Response
    {
        $publicacion = new Publicacion();
        $usuario = $this->getUser();
        $form = $this->createForm(PublicacionType::class, $publicacion);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $publicacion->setFecha(new \DateTime);
            $publicacion->setUser($usuario);
            $image = $form->get('Image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
                try {
                    $image->move(
                        $this->getParameter('publication_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception ($e);
                }
                $publicacion->setImage($newFilename);
            }
            $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($publicacion);
            $entityManager->flush();
            return $this->redirectToRoute('app_publicacion');
        }
        return $this->render('/publicacion/index.html.twig',[
         'formulario' => $form->createView(),
        ]);
        }
}
