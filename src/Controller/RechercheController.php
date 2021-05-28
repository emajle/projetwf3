<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Repository\SpecialisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche/accessoires', name: 'recherche_accessoires')]
    public function accessoires(Request $request, ProduitRepository $pr): Response
    {
        $mot = $request->query->get("mot");
        $produits = $pr->findByMot($mot);
        return $this->render('recherche/accessoires.html.twig', compact("mot", "produits"));
    }

    #[Route('/recherche/specialistes', name: 'recherche_specialiste')]
    public function specialistes(Request $request, SpecialisteRepository $sr): Response
    {
        $mot = $request->query->get("mot");
        $specialistes = $sr->findByMot($mot);
        return $this->render('recherche/specialiste.html.twig', compact("mot", "specialistes"));
    }
}
