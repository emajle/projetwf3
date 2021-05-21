<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EBoutiqueController extends AbstractController
{
    #[Route('/e/boutique', name: 'e_boutique')]
    public function index(ProduitRepository $pr): Response
    {
        return $this->render('e_boutique/index.html.twig', [
            'produits' => $pr->findAll(),
        ]);
    }
}
