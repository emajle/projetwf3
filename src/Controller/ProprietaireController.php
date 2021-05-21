<?php

namespace App\Controller;

use App\Entity\Animal;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProprietaireController extends AbstractController
{
    #[Route('/proprio', name: 'app_proprio')]
    public function index(): Response
    {
        return $this->render('proprio/index.html.twig', [
            'controller_name' => 'ProprietaireController',
        ]);
    }


    #[Route('/conseil', name: 'app_conseil')]

    public function conseil(): Response
    {

        return $this->render('proprio/conseil.html.twig', []);
    }

    #[Route('/education', name: 'app_education')]

    public function education(): Response
    {
        return $this->render('proprio/reponse_conseil.html.twig', []);
    }

    #[Route('/quotidien', name: 'app_quotidien')]

    public function quotidien(): Response
    {
        return $this->render('proprio/reponse_conseil.html.twig', []);
    }
}
