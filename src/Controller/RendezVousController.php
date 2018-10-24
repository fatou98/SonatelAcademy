<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Repository\RendezVousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rendez/vous")
 */
class RendezVousController extends AbstractController
{
    /**
     * @Route("/", name="rendez_vous_index", methods="GET")
     */
    public function index(RendezVousRepository $rendezVousRepository): Response
    {
        $user=$this->getUser();

        return $this->render('rendez_vous/index.html.twig', ['user'=>$user,'rendez_vouses' => $rendezVousRepository->findAll()]);
    }

    /**
     * @Route("/new", name="rendez_vous_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user=$this->getUser();

        $rendezVous = new RendezVous();
        $form = $this->createForm(RendezVousType::class, $rendezVous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rendezVous);
            $em->flush();

            return $this->redirectToRoute('rendez_vous_index');
        }

        return $this->render('rendez_vous/new.html.twig', [
            'rendez_vous' => $rendezVous,
            'form' => $form->createView(),
            'user'=>$user
        ]);
    }

    /**
     * @Route("/{id}", name="rendez_vous_show", methods="GET")
     */
    public function show(RendezVous $rendezVous): Response
    {
        $user=$this->getUser();

        return $this->render('rendez_vous/show.html.twig', ['rendez_vous' => $rendezVous,'user'=>$user]);
    }

    /**
     * @Route("/{id}/edit", name="rendez_vous_edit", methods="GET|POST")
     */
    public function edit(Request $request, RendezVous $rendezVous): Response
    {
        $user=$this->getUser();

        $form = $this->createForm(RendezVousType::class, $rendezVous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rendez_vous_edit', ['id' => $rendezVous->getId()]);
        }

        return $this->render('rendez_vous/edit.html.twig', [
            'rendez_vous' => $rendezVous,
            'form' => $form->createView(),
            'user'=>$user
        ]);
    }

    /**
     * @Route("/{id}", name="rendez_vous_delete", methods="DELETE")
     */
    public function delete(Request $request, RendezVous $rendezVous): Response
    {
        $user=$this->getUser();

        if ($this->isCsrfTokenValid('delete'.$rendezVous->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rendezVous);
            $em->flush();
        }

        return $this->redirectToRoute('rendez_vous_index');
    }
}
