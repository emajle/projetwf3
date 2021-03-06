<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\QrCode;
use App\Entity\CarnetSante;
use App\Entity\VisiteMedical;
use App\Form\CarnetSanteType;
use App\Repository\QrCodeRepository;
use App\Repository\CarnetSanteRepository;
use App\Repository\VisiteMedicalRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VaccinsEtOperationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/abonne/carnet')]
class CarnetSanteController extends AbstractController
{
    #[Route('/', name: 'carnet_sante_index', methods: ['GET'])]
    public function index(CarnetSanteRepository $carnetSanteRepository): Response
    {

        return $this->render('carnet_sante/index.html.twig', [
            'carnet_santes' => $carnetSanteRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'carnet_sante_show', methods: ['GET'])]
    public function show(CarnetSante $carnetSante, VisiteMedicalRepository $vr, Request $request, QrCodeRepository $qr,): Response
    {
        if (!$qr->aideqrcode($carnetSante->getId())) {
            $host = $request->getHttpHost();
            $suite = $request->getPathInfo();
            //dd($referer = $request->headers->get('referer'));
            $url = $host . $suite;
            $qrCode = new QrCode();
            $qrCode->setCarnet($carnetSante);
            $qrCode->setImageQrc("http://" . $url);

            //Creation du qrcode en bdd
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($qrCode);
            $entityManager->flush();
        }

        $visites = $vr->jointCarnetVisite($carnetSante->getId());
        return $this->render('carnet_sante/show.html.twig', [
            'carnet_sante' => $carnetSante,
            'visites' => $visites,
            // 'idanimal' => $idanimal,

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
