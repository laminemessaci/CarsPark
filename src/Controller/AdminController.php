<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Entity\Voiture;
use App\Form\RechercheVoitureType;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(VoitureRepository $repository, PaginatorInterface $paginatorInterface, Request $request)
    {
        //Form for ReschercheVoiture Entity
        $rechercheVoiture = new RechercheVoiture();
        $form = $this->createForm(RechercheVoitureType::class, $rechercheVoiture);
        $form->handleRequest($request);

        $voitures = $paginatorInterface->paginate(
            $repository->findAllWithPagination($rechercheVoiture), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('voiture/voitures.html.twig', [
            "voitures" => $voitures,
            "form" => $form->createView(),
            "admin" => true
        ]);
    }

    /**
     * @Route("/admin/creation", name="creationVoiture")
     * @Route("/admin/{id}", name="modifVoiture", methods="GET|POST")
     */
    public function modification(Voiture $voiture = null, Request $request){

        if( !$voiture) $voiture = new Voiture();
        $manager  = $this->getDoctrine()->getManager();
    $form = $this -> createForm(VoitureType::class, $voiture);

        $form ->handleRequest($request);
        if ( $form ->isSubmitted() && $form->isValid()){
            $manager ->persist($voiture);
            $this -> addFlash('success', "L'action a été effectuée avec succé !");
            $manager->flush();
            return  $this->redirectToRoute("admin");

        }
        return $this->render('admin/modification.html.twig', [
            "voiture" => $voiture,
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="supVoiture", methods= "SUP")
     */
    public function suppression(Voiture $voiture, Request $request){

        $manager = $this->getDoctrine()->getManager();
        if ($this->isCsrfTokenValid("SUP".$voiture->getId(), $request->get("_token"))){
            $manager->remove($voiture);
            $manager->flush();
            $this->addFlash('success', "La voiture a bien été supprimée !");
            return $this->redirectToRoute("admin");
        }


    }
}
