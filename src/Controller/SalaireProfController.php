<?php

namespace App\Controller;

use App\Entity\SalaireProf;
use App\Form\SalaireProfType;
use App\Repository\SalaireProfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salaire/prof")
 */
class SalaireProfController extends AbstractController
{
    /**
     * @Route("/", name="salaire_prof_index", methods="GET")
     */
    public function index(SalaireProfRepository $salaireProfRepository): Response
    {
        $user=$this->getUser();

        return $this->render('salaire_prof/index.html.twig', [
            'user'=>$user,'salaire_profs' => $salaireProfRepository->findAll()]);
    }

    /**
     * @Route("/new", name="salaire_prof_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user=$this->getUser();

        $salaireProf = new SalaireProf();
        $form = $this->createForm(SalaireProfType::class, $salaireProf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salaireProf);
            $em->flush();

            return $this->redirectToRoute('salaire_prof_index');
        }

        return $this->render('salaire_prof/new.html.twig', [
            'salaire_prof' => $salaireProf,
            'form' => $form->createView(),
            'user'=>$user,
        ]);
    }

    /**
     * @Route("/{id}", name="salaire_prof_show", methods="GET")
     */
    public function show(SalaireProf $salaireProf): Response
    {
        $user=$this->getUser();

        return $this->render('salaire_prof/show.html.twig', ['salaire_prof' => $salaireProf, 'user'=>$user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="salaire_prof_edit", methods="GET|POST")
     */
    public function edit(Request $request, SalaireProf $salaireProf): Response
    {
        $form = $this->createForm(SalaireProfType::class, $salaireProf);
        $form->handleRequest($request);
        $user=$this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salaire_prof_edit', ['id' => $salaireProf->getId()]);
        }

        return $this->render('salaire_prof/edit.html.twig', [
            'salaire_prof' => $salaireProf,
            'form' => $form->createView(), 'user'=>$user,
        ]);
    }

    /**
     * @Route("/{id}", name="salaire_prof_delete", methods="DELETE")
     */
    public function delete(Request $request, SalaireProf $salaireProf): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salaireProf->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($salaireProf);
            $em->flush();
        }

        return $this->redirectToRoute('salaire_prof_index');
    }
}
