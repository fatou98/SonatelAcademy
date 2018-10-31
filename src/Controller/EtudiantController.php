<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FiliereRepository;

    /**
     * @Route("/etudiant")
     */
class EtudiantController extends AbstractController
{
    /**
     * @Route("/rechercheretudiant", name="etudiant_index", methods="GET")
     */
    public function index(EtudiantRepository $etudiantRepository): Response
    {
        $user=$this->getUser();
        $etudiants=$etudiantRepository->findAll();
        foreach ($etudiants as  $values) {
            $values->setImage(base64_encode(stream_get_contents($values->getImage())));
        }

        return $this->render('etudiant/index.html.twig', [
            'user'=>$user,
            'etudiants' => $etudiants]);
    }

    /**
     * @Route("/new", name="etudiant_new", methods="GET|POST")
     */
    public function new(Request $request,FiliereRepository $filiererepo): Response
    {
        $user=$this->getUser();

        $etudiant = new Etudiant();
       if(isset($_POST['ajouter'])){
           if($request->isMethod('POST')){
           extract($_POST);
           
        $etudiant->setPrenom($prenom);
        $etudiant->setNom($nom);
        $etudiant->setDateofbirth($dateofbirth);
        $etudiant->setLieunaissance($lieunaissance);
        $etudiant->setEmail($email);
        $etudiant->setNumpiece($cni);
        $etudiant->setMobileNumber($portable);
        $etudiant->setFixNumber($fixnumber);
        $etudiant->setAdresse($adresseli);
        $etudiant->setFiliere($filiererepo->findOneBy(['id'=>$filiere]));
        $etudiant->setImage(file_get_contents($_FILES['img']['tmp_name']));
        $em = $this->getDoctrine()->getManager();
        $em->persist($etudiant);
        $em->flush();
        $this->addFlash('success', 'Etudiant enregistré avec success.');

       }
    }
        
        return $this->render('etudiant/addEtudiant.html.twig', [
            'etudiant' => $etudiant,
            'user'=>$user,
            'filieres'=>$filiererepo->findAll()
        ]);
    }

    /**
     * @Route("/{id}", name="etudiant_show", methods="GET")
     */
    public function show(Etudiant $etudiant): Response
    {
        $user=$this->getUser();

        $etudiant->setImage(base64_encode(stream_get_contents($etudiant->getImage())));

        return $this->render('etudiant/show.html.twig', ['etudiant' => $etudiant,
        'user'=>$user
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etudiant_edit", methods="GET|POST")
     */
    public function edit(Request $request, Etudiant $etudiant): Response
    {
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        $user=$this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etudiant_edit', ['id' => $etudiant->getId()]);
        }

        return $this->render('etudiant/edit.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form->createView(),
            'user'=>$user,

        ]);
    }

    /**
     * @Route("/{id}", name="etudiant_delete", methods="DELETE")
     */
    public function delete(Request $request, Etudiant $etudiant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etudiant->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etudiant);
            $em->flush();
        }

        return $this->redirectToRoute('etudiant_index');
    }
}
