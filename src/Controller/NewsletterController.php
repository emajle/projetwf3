<?php

namespace App\Controller;

use App\Entity\Newsletter\Newsletter;
use App\Entity\Newsletter\Newsletters;
use App\Entity\Newsletter\Usernews;
use App\Form\NewsletterType;
use App\Form\NewsletterUsernewsType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter', name: 'newsletter')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $usernews = new Usernews();
        $form = $this->createForm(NewsletterUsernewsType::class, $usernews);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $token = hash('sha256', uniqid());

            $usernews->setValidationToken($token);

            $em = $this->getDoctrine()->getManager();
            $em->persist($usernews);
            $em->flush();

            $email = (new TemplatedEmail())
                ->from('MyCarePet@carepet.fr')
                ->to($usernews->getEmail())
                ->subject('Inscription à la Newsletter')
                ->htmlTemplate('emails/inscription.html.twig')
                ->context(compact('usernews', 'token'));

            $mailer->send($email);

            $this->addFlash('message', 'Inscription en cours de validation');
            return $this->redirectToRoute('app_home');
        }


        return $this->render('newsletter/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/confirm/{id}/{token}", name="confirm-news")
     */
    public function confirm(Usernews $usernews, $token): Response
    {
        if ($usernews->getValidationToken() != $token) {
            throw $this->createNotFoundException('Page non trouvée');
        }
        $usernews->setIsValid(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($usernews);
        $em->flush();

        $this->addFlash('message', 'Newsletter acceptée');
        return $this->redirectToRoute('app_home');
    }

    /**
     * @Route("/unsubscribe/{id}/{token}", name="unsubscribe")
     */
    public function unsubscribe(Usernews $usernews, Newsletters $newsletters, $token): Response
    {
        if ($usernews->getValidationToken() != $token) {
            throw $this->createNotFoundException('Page non trouvée');
        }

        $em = $this->getDoctrine()->getManager();
        if (count($usernews->getCatenews()) > 1) {
            $usernews->removeCatenews($newsletters->getCatenews());
            $em->persist($usernews);
        } else {
            $em->remove($usernews);
        }
        $em->flush();

        $this->addFlash('message', 'Désabonné à la newsletter');

        return $this->redirectToRoute('app_home');
    }
}
