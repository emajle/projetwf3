<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitRepository;
use App\Repository\QrCodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EBoutiqueController extends AbstractController
{
    #[Route('/boutique', name: 'e_boutique')]
    public function index(): Response
    {
        return $this->render('e_boutique/index.html.twig');
    }

    #[Route('boutique/accessoires', name: 'e_boutique_accessoires')]
    public function accessoires(ProduitRepository $pr): Response
    {
        return $this->render('e_boutique/accessoires.html.twig', [
            'produits' => $pr->findAll(),
        ]);
    }


    #[Route('boutique/abonnement', name: 'e_boutique_abonnement')]
    public function abonnement(QrCodeRepository $qrc): Response
    {
        return $this->render('e_boutique/abonnement.html.twig');
    }
}
