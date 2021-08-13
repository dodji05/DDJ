<?php

namespace App\Controller\Administration\Main;

use App\Entity\Une;
use App\Form\UneType;
use App\Repository\UneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("espace-admin/la-une")
 */
class UneController extends AbstractController
{
    /**
     * @Route("/", name="la_une_index", methods={"GET"})
     */
    public function index(UneRepository $uneRepository): Response
    {
        return $this->render('BackEnd/Main/une/index.html.twig', [
            'unes' => $uneRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="la_une_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $une = new Une();
        $form = $this->createForm(UneType::class, $une);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($une);
            $entityManager->flush();
            $this->addFlash('success','L\'image de la une a été bien ajoutée');
            return $this->redirectToRoute('la_une_index');
        }

        return $this->render('BackEnd/Main/une/new.html.twig', [
            'une' => $une,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="la_une_show", methods={"GET"})
     */
    public function show(Une $une): Response
    {
        return $this->render('BackEnd/Main/une/show.html.twig', [
            'une' => $une,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="la_une_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Une $une): Response
    {
        $form = $this->createForm(UneType::class, $une);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('la_une_index');
        }

        return $this->render('BackEnd/Main/une/edit.html.twig', [
            'une' => $une,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="la_une_delete", methods={"POST"})
     */
    public function delete(Request $request, Une $une): Response
    {
        if ($this->isCsrfTokenValid('delete'.$une->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($une);
            $entityManager->flush();
        }

        return $this->redirectToRoute('la_une_index');
    }
}
