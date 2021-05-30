<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitRepository;
use App\Repository\QrCodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/boutique')]
class EBoutiqueController extends AbstractController
{
    #[Route('/', name: 'e_boutique')]
    public function index(): Response
    {
        return $this->render('e_boutique/index.html.twig');
    }

    #[Route('/accessoires', name: 'e_boutique_accessoires')]
    public function accessoires(ProduitRepository $pr): Response
    {
        return $this->render('e_boutique/accessoires.html.twig', [
            'produits' => $pr->findAll(),
        ]);
    }


    #[Route('/abonnement', name: 'e_boutique_abonnement')]
    public function abonnement(QrCodeRepository $qrc): Response
    {
        return $this->render('e_boutique/abonnement.html.twig');
    }
}
