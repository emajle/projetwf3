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
        $titreModal = "Animal";
        $user = $this->getUser();
        $animal = new Animal();
        $animal->setMembre($user);
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        $ac->newModalAnimal($request, $carnet, $form, $animal);

        return $this->render('profil/index.html.twig', [
            "animaux" => $aR->idAnimal($this->getUser()->getId()),
            'form' => $form->createView(),
            "titre" => $titreModal,

        ]);
    }
}
