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
}
