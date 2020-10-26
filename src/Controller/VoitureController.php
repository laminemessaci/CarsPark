<?php

namespace App\Controller;

use App\Entity\RechercheVoiture;
use App\Form\RechercheVoitureType;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    /**
     * @Route("/client/voitures", name="voitures")
     */
    public function index(VoitureRepository $repository, PaginatorInterface $paginatorInterface, Request  $request)
    {

        //Form for ReschercheVoiture Entity
        $rechercheVoiture = new RechercheVoiture();
        $form = $this->createForm(RechercheVoitureType::class, $rechercheVoiture);
        $form ->handleRequest($request);

        $voitures = $paginatorInterface -> paginate(
            $repository->findAllWithPagination( $rechercheVoiture) , /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('voiture/voitures.html.twig',[
            "voitures" => $voitures,
            "form" => $form ->createView(),
            "admin" => false
        ]);
    }
}
