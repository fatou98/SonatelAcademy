<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/addEtudiant", name="addEtudiant")
     */
    public function addEtudiant()
    {
        $user=$this->getUser();

        return $this->render('etudiant/addEtudiant.html.twig', [
            'controller_name' => 'EtudiantController','user'=>$user
        ]);
    }
    /**
     * @Route("/rechercherEtudiant", name="rechercherEtudiant")
     */
    public function rechercherEtudiant()
    {
        $user=$this->getUser();

        return $this->render('etudiant/rechercherEtudiant.html.twig', [
            'controller_name' => 'EtudiantController','user'=>$user
        ]);
    }
}
