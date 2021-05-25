<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Animal;
use App\Form\AnimalType;
use App\Controller\AnimalController;
use App\Repository\AnimalRepository;
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
        $user = $this->getUser();
        $animal = new Animal();
        $animal->setMembre($user);
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmis
            $images = $form->get('image')->getData();
            // On Boucle nos images
            foreach ($images as $image) {
                // Generée un nom aleatoire pour l'image
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On stocke l'image dans la BDD (son nom)
                $img = new Image();
                $img->setName($fichier);
                $animal->addImage($img);
            }
            //
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($animal);
            $carnet->new($animal);

            $entityManager->flush();
            $request->getSession();
            $this->addflash('success', 'Votre inscription a été enregistré.');
            return $this->redirectToRoute('profil');
        }


        return $this->render('profil/index.html.twig', [
            "animaux" => $aR->idAnimal($this->getUser()->getId()),
            'form' => $form->createView(),

        ]);
    }
}
