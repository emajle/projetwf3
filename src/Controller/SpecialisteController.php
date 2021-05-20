<?php

namespace App\Controller;

use App\Entity\Specialiste;
use App\Form\SpecialisteType;
use App\Repository\SpecialisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/specialiste')]
class SpecialisteController extends AbstractController
{
    #[Route('/', name: 'specialiste_index', methods: ['GET'])]
    public function index(SpecialisteRepository $specialisteRepository): Response
    {
        return $this->render('specialiste/index.html.twig', [
            'specialistes' => $specialisteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'specialiste_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $specialiste = new Specialiste();
        $form = $this->createForm(SpecialisteType::class, $specialiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specialiste);
            $entityManager->flush();

            return $this->redirectToRoute('specialiste_index');
        }

        return $this->render('specialiste/new.html.twig', [
            'specialiste' => $specialiste,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'specialiste_show', methods: ['GET'])]
    public function show(Specialiste $specialiste): Response
    {
        return $this->render('specialiste/show.html.twig', [
            'specialiste' => $specialiste,
        ]);
    }

    #[Route('/{id}/edit', name: 'specialiste_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Specialiste $specialiste): Response
    {
        $form = $this->createForm(SpecialisteType::class, $specialiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('specialiste_index');
        }

        return $this->render('specialiste/edit.html.twig', [
            'specialiste' => $specialiste,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'specialiste_delete', methods: ['POST'])]
    public function delete(Request $request, Specialiste $specialiste): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specialiste->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($specialiste);
            $entityManager->flush();
        }

        return $this->redirectToRoute('specialiste_index');
    }
}
