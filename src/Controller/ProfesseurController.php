<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfesseurController extends AbstractController
{
    /**
     * @Route("/professeur", name="professeur")
     */
    public function index()
    {
        $user=$this->getUser();
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController','user'=>$user
        ]);
    }
}
