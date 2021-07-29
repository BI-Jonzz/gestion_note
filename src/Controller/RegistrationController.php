<?php

namespace App\Controller;

use App\Entity\Gestionnaire;
use App\Entity\User;
use App\Form\GestionnaireType;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $gestionnaire = new Gestionnaire();
        $form = $this->createForm(GestionnaireType::class, $gestionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setLogin($form->get('login')->getData());

            $user->setRoles(['ROLE_GESTIONNAIRE']);

            $gestionnaire->setUserId($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($gestionnaire);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('etudiant_index');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
