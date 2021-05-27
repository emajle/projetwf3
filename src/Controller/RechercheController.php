<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'recherche')]
    public function index(Request $request, ProduitRepository $pr): Response // pour pouvoir utiliser livre repository dans lequel on a fait la requete de selection "LivreRepository
    {
        $mot = $request->query->get("mot"); // methode query pour le GET, puis get pour "recupérer" mot
        $produits = $pr->findByMot($mot);
        return $this->render('recherche/index.html.twig', compact("mot", "produits"));
    }
}
