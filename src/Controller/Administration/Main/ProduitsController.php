<?php

namespace App\Controller\Administration\Main;

use App\Entity\Produits;
use App\Entity\ProduitsVariants;
use App\Form\ProduitsType;
use App\Repository\CategorieProduitsRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace-admin/produits")
 */
class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="admin_produits_index", methods={"GET"})
     */
    public function index(ProduitsRepository $produitsRepository): Response
    {
        return $this->render('BackEnd/produits/index.html.twig', [
            'produits' => $produitsRepository->findAll(),
            'TBTitle' => 'Gestion des produits',
            'TBSuTitle' => 'Produits',
            'TBCurrent' =>'Tous les produits'
        ]);
    }

    /**
     * @Route("/new", name="admin_produits_new", methods={"GET","POST"})
     */
    public function new(Request $request, CategorieProduitsRepository $categorieProduitsRepository): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $produit->setPrix(300);
            $produit->setDisponible(true);
            $produit->setCategorie($categorieProduitsRepository->find(1));
            // ajout des variants
            $numerique = new ProduitsVariants();
            $numerique->setLibelle("Version numérique")
                ->setProduits($produit)
            ->setSlug($produit->getNom()."-version-numerique")
            ->setPrix(300)
            ->setUrlLiseuse($form->get('urlLiseuse')->getData());

            $papier = new ProduitsVariants();
            $papier->setLibelle("Version papier")
                ->setProduits($produit)
                ->setSlug($produit->getNom()."-version-papier")
                ->setUrlLiseuse($form->get('urlLiseuse')->getData())
                ->setPrix(300);



            $entityManager->persist($produit);
            $entityManager->persist($numerique);
            $entityManager->persist($papier);
            $entityManager->flush();
            $this->addFlash('success','Le produit a été ajouté avec succes !');
            return $this->redirectToRoute('admin_produits_index');
        }

        return $this->render('BackEnd/produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
            'TBTitle' => 'Gestion des produits',
            'TBSuTitle' => 'Produits',
            'TBCurrent' =>'Nouveau produit'
        ]);
    }

    /**
     * @Route("/{id}", name="admin_produits_show", methods={"GET"})
     */
    public function show(Produits $produit): Response
    {
        return $this->render('BackEnd/produits/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_produits_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produits $produit): Response
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Le produit a été modifié avec succes !');
            return $this->redirectToRoute('admin_produits_index');
        }

        return $this->render('BackEnd/produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
            'TBTitle' => 'Gestion des produits',
            'TBSuTitle' => 'Produits',
            'TBCurrent' =>'Modification'
        ]);
    }

    /**
     * @Route("/{id}", name="admin_produits_delete", methods={"POST"})
     */
    public function delete(Request $request, Produits $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
            $this->addFlash('success','Le produit a été supprimé avec succes !');
        }

        return $this->redirectToRoute('admin_produits_index');
    }
}
