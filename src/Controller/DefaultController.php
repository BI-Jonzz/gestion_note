<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\User;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods={"GET"})
     */
    public function index(EtudiantRepository $etudiantRepository): Response
    {
        $user = $this->getUser();

        if ($user) {
            if (in_array('ROLE_ETUDIANT', $this->getUser()->getRoles()) ) {
                return $this->redirectToRoute('notes_index');
            } else {
                return $this->redirectToRoute('etudiant_index',  [
                    'etudiants' => $etudiantRepository->findAll(),
                ]);
            }
        } else {
            return $this->redirectToRoute('app_login');
        }
    }


}
