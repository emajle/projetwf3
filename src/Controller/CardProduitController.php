<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardProduitController extends AbstractController
{
    #[Route('/card/produit', name: 'card_produit')]
    public function index(): Response
    {
        return $this->render('card_produit/index.html.twig', [
            'controller_name' => 'CardProduitController',
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="cardproduit_add")
     */

    public function add($id, Request $request)
    {
        $session = $request->getSession();

        $panier = $session->get('panier', []); //récupération du panier

        if (!empty($panier[$id])) {

            $panier[$id]++;
        } else {

            $panier[$id] = 1;
        }


        $session->set('panier', $panier);

        dd($session->get('panier'));
    }
}
