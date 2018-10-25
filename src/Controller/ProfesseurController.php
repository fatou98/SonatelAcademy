<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtudiantRepository;
use App\Repository\RendezVousRepository;
use App\Repository\RetardRepository;

class ProfesseurController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(EtudiantRepository $etudiantrepo,RendezVousRepository $rdvrepo,RetardRepository $retardrepo)
    {
        $user=$this->getUser();
       $nombreetudiant=count($etudiantrepo->findAll());
       $nombrerdv=count($rdvrepo->findAll());
       $nombreretard=count($retardrepo->findAll());
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
            'user'=>$user,
            'nombreetudiant'=>$nombreetudiant,
            'nombrerdv'=>$nombrerdv,
            'nombreretard'=>$nombreretard,
        ]);
    }
}
