<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Animal;
use App\Form\AnimalType;
use App\Controller\AnimalController;
use App\Repository\AnimalRepository;
use Symfony\Component\Form\FormView;
use App\Controller\CarnetSanteController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    #[IsGranted("IS_AUTHENTICATED_FULLY")]

    public function index(AnimalRepository $aR, AnimalController $ac, Request $request, CarnetSanteController $carnet): Response
    {
        return $this->render('profil/index.html.twig', []);
    }
}
