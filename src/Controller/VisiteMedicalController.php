<?php

namespace App\Controller;

use App\Entity\CarnetSante;
use App\Entity\VisiteMedical;
use App\Form\VisiteMedicalType;
use App\Repository\VisiteMedicalRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/membre/vm')]
class VisiteMedicalController extends AbstractController
{
    #[Route('/', name: 'visite_medical_index', methods: ['GET'])]
    public function index(VisiteMedicalRepository $visiteMedicalRepository): Response
    {
        return $this->render('visite_medical/index.html.twig', [
            'visite_medicals' => $visiteMedicalRepository->findAll(),
        ]);
    }

    #[Route('/{id}/new', name: 'visite_medical_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CarnetSante $carnet): Response
    {

        $visiteMedical = new VisiteMedical();
        $visiteMedical->setCarnet($carnet);
        $form = $this->createForm(VisiteMedicalType::class, $visiteMedical);
        $form->handleRequest($request);
        $id = $carnet->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visiteMedical);
            $entityManager->flush();

            return $this->redirectToRoute('carnet_sante_show', array('id' => $id));
        }

        return $this->render('visite_medical/new.html.twig', [
            'visite_medical' => $visiteMedical,
            'form' => $form->createView(),
        ]);
    }

    public function newModalVisite($form, $visiteMedical)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visiteMedical);
            $entityManager->flush();
            $id = $this->getUser();

            return $this->redirectToRoute('profil', array('id' => $id));
        }
    }

    #[Route('/{id}', name: 'visite_medical_show', methods: ['GET'])]
    public function show(VisiteMedical $visiteMedical): Response
    {
        return $this->render('visite_medical/show.html.twig', [
            'visite_medical' => $visiteMedical,
        ]);
    }

    #[Route('/{id}/edit', name: 'visite_medical_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VisiteMedical $visiteMedical): Response
    {
        $form = $this->createForm(VisiteMedicalType::class, $visiteMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visite_medical_index');
        }

        return $this->render('visite_medical/edit.html.twig', [
            'visite_medical' => $visiteMedical,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'visite_medical_delete', methods: ['POST'])]
    public function delete(Request $request, VisiteMedical $visiteMedical): Response
    {
        if ($this->isCsrfTokenValid('delete' . $visiteMedical->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($visiteMedical);
            $entityManager->flush();
        }

        return $this->redirectToRoute('visite_medical_index');
    }
}
