<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use App\Controller\CarnetSanteController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/animal')]
class AnimalController extends AbstractController
{
    #[Route('/', name: 'animal_index', methods: ['GET'])]
    public function index(AnimalRepository $animalRepository): Response
    {
        return $this->render('animal/index.html.twig', [
            'animals' => $animalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'animal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CarnetSanteController $carnet): Response
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

            return $this->redirectToRoute('animal_index');
        }

        return $this->render('animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }

    public function newModal(Request $request, CarnetSanteController $carnet, $user)
    {
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
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }






    #[Route('/{id}', name: 'animal_show', methods: ['GET'])]
    public function show(Animal $animal): Response
    {
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
        ]);
    }

    #[Route('/{id}/edit', name: 'animal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Animal $animal): Response
    {
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

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('animal_index');
        }

        return $this->render('animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'animal_delete', methods: ['POST'])]
    public function delete(Request $request, Animal $animal): Response
    {
        if ($this->isCsrfTokenValid('delete' . $animal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('animal_index');
    }

    //Gerée la suppréssion d'une image
    #[Route('/supprime/image/{id}', name: "app_delete_image", methods: ['DELETE'])]

    public function deleteImage(Image $image, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        dd($data);
        // On verifie si le token est valide (token pour securiser)
        if ($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])) {
            //Recupere le non de l'image 
            $nom = $image->getName();
            //On supprime le fichier
            unlink($this->getParameter('images_directory') . '/' . $nom);

            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();

            // On repond en Json
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token invalide'], 400);
        }
    }
}
