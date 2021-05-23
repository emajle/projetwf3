<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\CarnetSante;
use App\Form\CarnetSanteType;
use App\Repository\CarnetSanteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/carnet')]
class CarnetSanteController extends AbstractController
{
    #[Route('/', name: 'carnet_sante_index', methods: ['GET'])]
    public function index(CarnetSanteRepository $carnetSanteRepository): Response
    {

        return $this->render('carnet_sante/index.html.twig', [
            'carnet_santes' => $carnetSanteRepository->findAll(),
        ]);
    }

    public function new(Animal $animal)
    {
        $carnetSante = new CarnetSante();
        $carnetSante->setAnimal($animal);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($carnetSante);
        $entityManager->flush();
    }

    #[Route('/{id}', name: 'carnet_sante_show', methods: ['GET'])]
    public function show(CarnetSante $carnetSante): Response
    {
        return $this->render('carnet_sante/show.html.twig', [
            'carnet_sante' => $carnetSante,
        ]);
    }

    #[Route('/{id}/edit', name: 'carnet_sante_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CarnetSante $carnetSante): Response
    {
        $form = $this->createForm(CarnetSanteType::class, $carnetSante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carnet_sante_index');
        }

        return $this->render('carnet_sante/edit.html.twig', [
            'carnet_sante' => $carnetSante,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'carnet_sante_delete', methods: ['POST'])]
    public function delete(Request $request, CarnetSante $carnetSante): Response
    {
        if ($this->isCsrfTokenValid('delete' . $carnetSante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carnetSante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carnet_sante_index');
    }
}
