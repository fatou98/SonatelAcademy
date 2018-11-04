<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtudiantRepository;
use App\Repository\RendezVousRepository;
use App\Repository\RetardRepository;
use App\Repository\HeureProfRepository;

/**
 * @Route("/professeur")
 */
class ProfesseurController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(EtudiantRepository $etudiantrepo,RendezVousRepository $rdvrepo,RetardRepository $retardrepo)
    {
        $user=$this->getUser();
       $nombreetudiant=count($etudiantrepo->findAll());
       $nombrerdv=count($rdvrepo->findAll());
       $nombreretard=count($retardrepo->findAll());
        return $this->render('professeur/dashboard.html.twig', [
            'controller_name' => 'ProfesseurController',
            'user'=>$user,
            'nombreetudiant'=>$nombreetudiant,
            'nombrerdv'=>$nombrerdv,
            'nombreretard'=>$nombreretard,
        ]);
    }
    /**
     * @Route("/", name="professeur_index", methods="GET")
     */
    public function index(ProfesseurRepository $professeurRepository): Response
    {
        $user=$this->getUser();
        $professeurs=$professeurRepository->findAll();
        foreach ($professeurs as  $values) {
            $values->setImage(base64_encode(stream_get_contents($values->getImage())));
        }

        return $this->render('professeur/index.html.twig', [ 
            'user'=>$user,
            'professeurs' =>$professeurs ]);
    }

    /**
     * @Route("/new", name="professeur_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $professeur = new Professeur();
        $user=$this->getUser();
        if(isset($_POST['ajouter'])){
            if($request->isMethod('POST')){
            extract($_POST);
            
         $professeur->setPrenom($prenom);
         $professeur->setNom($nom);
         $professeur->setDateofbirth($dateofbirth);
         $professeur->setLieunaissance($lieunaissance);
         $professeur->setEmail($email);
         $professeur->setNumpiece($cni);
         $professeur->setMobileNumber($portable);
         $professeur->setFixNumber($fixnumber);
         $professeur->setAdresse($adresseli);
         $professeur->setImage(file_get_contents($_FILES['img']['tmp_name']));
         $em = $this->getDoctrine()->getManager();
         $em->persist($professeur);
         $em->flush();
         $this->addFlash('success', 'Professeur enregistré avec success.');
            }
        } 

        return $this->render('professeur/addprof.html.twig', [
            'user'=>$user,

        ]);
    }

    /**
     * @Route("/{id}", name="professeur_show", methods="GET")
     */
    public function show(Professeur $professeur,HeureProfRepository $heureprofrepo,$id): Response
    {
        $somme=0;
       foreach ($professeur->getHeureProfs() as  $value) {
           $somme=$somme+ $value->getNbreheure();
       }
        $user=$this->getUser();
        $professeur->setImage(base64_encode(stream_get_contents($professeur->getImage())));
        return $this->render('professeur/show.html.twig', ['somme'=>$somme,'professeur' => $professeur,     'user'=>$user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="professeur_edit", methods="GET|POST")
     */
    public function edit(Request $request, Professeur $professeur): Response
    {
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);
        $user=$this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Modifié avec success.');

            return $this->redirectToRoute('professeur_edit', ['id' => $professeur->getId()]);
        }

        return $this->render('professeur/edit.html.twig', [
            'professeur' => $professeur,
            'form' => $form->createView(),            'user'=>$user,

        ]);
    }

    /**
     * @Route("/{id}", name="professeur_delete", methods="DELETE")
     */
    public function delete(Request $request, Professeur $professeur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$professeur->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($professeur);
            $em->flush();
        }

        return $this->redirectToRoute('professeur_index');
    }
    
}
