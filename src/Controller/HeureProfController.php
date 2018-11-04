<?php

namespace App\Controller;

use App\Entity\HeureProf;
use App\Form\HeureProfType;
use App\Repository\HeureProfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/heure/prof")
 */
class HeureProfController extends AbstractController
{
    /**
     * @Route("/", name="heure_prof_index", methods="GET")
     */
    public function index(HeureProfRepository $heureProfRepository): Response
    {
        $user=$this->getUser();

        return $this->render('heure_prof/index.html.twig', [
            'user'=>$user,'heure_profs' => $heureProfRepository->findAll()]);
    }

    /**
     * @Route("/new", name="heure_prof_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user=$this->getUser();

        $heureProf = new HeureProf();
        $form = $this->createForm(HeureProfType::class, $heureProf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $heureProf->setDate(new \DateTime('now'));
            $em->persist($heureProf);
            $em->flush();

            return $this->redirectToRoute('heure_prof_index');
        }

        return $this->render('heure_prof/new.html.twig', [
            'heure_prof' => $heureProf,
            'form' => $form->createView(), 'user'=>$user,
        ]);
    }

    /**
     * @Route("/{id}", name="heure_prof_show", methods="GET")
     */
    public function show(HeureProf $heureProf): Response
    {
        $user=$this->getUser();

        return $this->render('heure_prof/show.html.twig', [
            'user'=>$user,'heure_prof' => $heureProf]);
    }

    /**
     * @Route("/{id}/edit", name="heure_prof_edit", methods="GET|POST")
     */
    public function edit(Request $request, HeureProf $heureProf): Response
    {
        $user=$this->getUser();

        $form = $this->createForm(HeureProfType::class, $heureProf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('heure_prof_edit', ['id' => $heureProf->getId()]);
        }

        return $this->render('heure_prof/edit.html.twig', [
            'heure_prof' => $heureProf,
            'form' => $form->createView(),
            'user'=>$user,
        ]);
    }

    /**
     * @Route("/{id}", name="heure_prof_delete", methods="DELETE")
     */
    public function delete(Request $request, HeureProf $heureProf): Response
    {
        if ($this->isCsrfTokenValid('delete'.$heureProf->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($heureProf);
            $em->flush();
        }

        return $this->redirectToRoute('heure_prof_index');
    }
}
