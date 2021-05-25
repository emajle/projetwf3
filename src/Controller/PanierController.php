<?php

namespace App\Controller;

use App\Repository\AbonnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{

    #[Route('/panier', name: 'panier')]
    public function index(SessionInterface $session, AbonnementRepository $aboRepo)
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];
        foreach ($panier as $id => $quantite) {
            $panierWithData[] = [
                'abonnement' => $aboRepo->find($id)
            ];
        }
        return $this->render('panier/index.html.twig', [
            'items' => $panierWithData,
        ]);
    }

    #[Route('/panier/add/{id}', name: 'panier_ajout')]
    public function add($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        /* if (!empty($panier[$id])) {
            $panier[$id]++;
        } else { */
        $panier[$id] = 1;
        //}

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');
    }

    #[Route('/panier/remove/{id}', name: 'panier_supprimer')]
    public function remove($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');
    }
}
