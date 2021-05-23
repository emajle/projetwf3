<?php

namespace App\Controller;

use App\Entity\VaccinsEtOperation;
use App\Form\VaccinsEtOperationType;
use App\Repository\VaccinsEtOperationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vo')]
class VaccinsEtOperationController extends AbstractController
{
    #[Route('/', name: 'vaccins_et_operation_index', methods: ['GET'])]
    public function index(VaccinsEtOperationRepository $vaccinsEtOperationRepository): Response
    {
        return $this->render('vaccins_et_operation/index.html.twig', [
            'vaccins_et_operations' => $vaccinsEtOperationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'vaccins_et_operation_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $vaccinsEtOperation = new VaccinsEtOperation();
        $form = $this->createForm(VaccinsEtOperationType::class, $vaccinsEtOperation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vaccinsEtOperation);
            $entityManager->flush();

            return $this->redirectToRoute('vaccins_et_operation_index');
        }

        return $this->render('vaccins_et_operation/new.html.twig', [
            'vaccins_et_operation' => $vaccinsEtOperation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'vaccins_et_operation_show', methods: ['GET'])]
    public function show(VaccinsEtOperation $vaccinsEtOperation): Response
    {
        return $this->render('vaccins_et_operation/show.html.twig', [
            'vaccins_et_operation' => $vaccinsEtOperation,
        ]);
    }

    #[Route('/{id}/edit', name: 'vaccins_et_operation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VaccinsEtOperation $vaccinsEtOperation): Response
    {
        $form = $this->createForm(VaccinsEtOperationType::class, $vaccinsEtOperation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vaccins_et_operation_index');
        }

        return $this->render('vaccins_et_operation/edit.html.twig', [
            'vaccins_et_operation' => $vaccinsEtOperation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'vaccins_et_operation_delete', methods: ['POST'])]
    public function delete(Request $request, VaccinsEtOperation $vaccinsEtOperation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vaccinsEtOperation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vaccinsEtOperation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vaccins_et_operation_index');
    }
}
