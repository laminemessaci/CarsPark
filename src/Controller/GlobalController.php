<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('global/accueil.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }


// inscription

    /**
     * @Route("/inscription", name="inscription")
     */
    public function sinscrire(Request $request, UserPasswordEncoderInterface $encodeur)
    {

        $manager = $this->getDoctrine()->getManager();
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);

        //recuperation du formulaire
        if (!$utilisateur->getRoles()) {
            $utilisateur->setRoles('USER_ROLE');
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $passwordCrypte = $encodeur->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
            $manager->persist($utilisateur);
            $manager->flush();
            return $this->redirectToRoute('accueil');
        }

        return $this->render('global/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //login

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $utils)
    {
        return $this->render('global/login.html.twig', [
            "lastUserName" => $utils->getLastUsername(),
            "error" => $utils->getLastAuthenticationError()
        ]);

    }

    //logout

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}
