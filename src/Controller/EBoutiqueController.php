<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitRepository;
use App\Repository\QrCodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EBoutiqueController extends AbstractController
{
    #[Route('/e/boutique', name: 'e_boutique')]
    public function index(): Response
    {
        return $this->render('e_boutique/index.html.twig');
    }

    #[Route('/e/boutique/accessoires', name: 'e_boutique_accessoires')]
    public function accessoires(ProduitRepository $pr, CategoriesRepository $catRep, HttpFoundationRequest $request): Response
    {


        // on récupère les filtres 
        $filters = $request->get("categories");

        $produits = $pr->findByCategorie($filters);

        if ($request->get('ajax')) {
            return new JsonResponse(array(
                'content' => $this->renderView('e_boutique/_content.html.twig', compact('produits'))
            ));
        }
        $categories = $catRep->findAll();

        return $this->render('e_boutique/accessoires.html.twig', [
            'produits' => $pr->findAll(),
            'categories' => $categories
        ]);
    }

    #[Route('/e/boutique/abonnement', name: 'e_boutique_abonnement')]
    public function abonnement(QrCodeRepository $qrc): Response
    {
        return $this->render('e_boutique/abonnement.html.twig');
    }
}
