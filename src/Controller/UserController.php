<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Abonnement;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Repository\AnimalRepository;
use App\Security\LoginAuthenticator;
use App\Repository\AbonnementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        $animaux = $userRepository->useranimal();
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'animaux' => $animaux
        ]);
    }
    #[Route('/admin/new', name: 'admin_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/{id}', name: 'user_show', methods: ['GET'])]
    public function show(User $user, AnimalRepository $ar): Response
    {
        $animaux = $ar->idAnimal($user->getId());
        //dd($animaux);
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'animaux' => $animaux
        ]);
    }

    #[Route('/{id}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    #[Route('abonnement/{idU}/{idA}', name: 'user_abonnement', methods: ['GET'])]
    public function abonnement($idA, $idU, UserRepository $userRepo, AbonnementRepository $aboRepo)
    {
        $user = $userRepo->find($idU);
        $abonnement = $aboRepo->find($idA);
        $user->setAbonnement($abonnement);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash("success", "Le paiement a bien été validé, vous êtes désormais abonné !");
        return $this->redirectToRoute('profil');
    }

    #[Route('remove/abonnement/{idU}', name: 'remove_abonnement', methods: ['GET'])]
    public function removeAbonnement($idU, UserRepository $userRepo)
    {
        $user = $userRepo->find($idU);
        $user->setAbonnement(null);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('profil');
    }
}
