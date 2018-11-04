<?php

namespace App\Controller;

use App\Entity\Retard;
use App\Form\RetardType;
use App\Repository\RetardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/retard")
 */
class RetardController extends AbstractController
{
    /**
     * @Route("/", name="retard_index", methods="GET")
     */
    public function index(RetardRepository $retardRepository): Response
    {
        $user=$this->getUser();

        return $this->render('retard/index.html.twig', ['user'=>$user,'retards' => $retardRepository->findAll()]);
    }

    /**
     * @Route("/new", name="retard_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user=$this->getUser();

        $retard = new Retard();
        $form = $this->createForm(RetardType::class, $retard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($retard);
            $em->flush();
$idetud=$retard->getEtudiant();
            return $this->redirectToRoute('etudiant_show', ['id' => $idetud->getId()]);
        }

        return $this->render('retard/new.html.twig', [
            'retard' => $retard,'user'=>$user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="retard_show", methods="GET")
     */
    public function show(Retard $retard): Response
    {
        $user=$this->getUser();

        return $this->render('retard/show.html.twig', ['user'=>$user,'retard' => $retard]);
    }

    /**
     * @Route("/{id}/edit", name="retard_edit", methods="GET|POST")
     */
    public function edit(Request $request, Retard $retard): Response
    {
        $user=$this->getUser();

        $form = $this->createForm(RetardType::class, $retard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('retard_edit', ['id' => $retard->getId()]);
        }

        return $this->render('retard/edit.html.twig', [
            'user'=>$user,
            'retard' => $retard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="retard_delete", methods="DELETE")
     */
    public function delete(Request $request, Retard $retard): Response
    {
        if ($this->isCsrfTokenValid('delete'.$retard->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($retard);
            $em->flush();
        }

        return $this->redirectToRoute('retard_index');
    }
}
