<?php

namespace App\Controller\Administration\Main;

use App\Entity\Dessins;
use App\Entity\Equipe;
use App\Form\DessinsType;
use App\Form\LockyType;
use App\Repository\DessinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace-admin/dessins")
 */
class DessinsController extends AbstractController
{
    /**
     * @Route("/", name="admin_dessins_index", methods={"GET"})
     */
    public function index(DessinsRepository $dessinsRepository): Response
    {
        return $this->render('BackEnd/dessins/index.html.twig', [
            'dessins' => $dessinsRepository->findAll(),
        ]);
    }
    /**
     * @Route("/dessinateur/{nom}", name="admin_dessins_auteur", methods={"GET"})
     */
    public function showdessinateurs(DessinsRepository $dessinsRepository, Equipe $dessinateur): Response
    {
        return $this->render('BackEnd/dessins/dessins_par_dessinateur.html.twig', [
            'auteur'=>$dessinsRepository->findBy(['auteur'=>$dessinateur]),
            'dessinateur'=>$dessinateur
        ]);
    }

    /**
     * @Route("/new", name="admin_dessins_new", methods={"GET","POST"})
     */
    public function new(Request $request ,DessinsRepository $dessinsRepository): Response
    {
        $tousDessins = $dessinsRepository->findBy(['genre'=>null],['id'=>'Desc']);
        $dessin = new Dessins();
        $form = $this->createForm(DessinsType::class, $dessin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // On récupère les images transmises
            $images = $form->get('images')->getData();

            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = $form->get('auteur')->getData()->getNom().'-'.md5(uniqid()).'.'.$image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('dessinateurs'),
                    $fichier
                );

                // On crée l'image dans la base de données

                $dessin1 = new Dessins();
                $dessin1->setAuteur($form->get('auteur')->getData());
                $dessin1->setImages($fichier);
                $entityManager->persist($dessin1);

            }

            $entityManager->flush();

            $this->addFlash('success','Les dessins ont été bien enregistrés !');
            return $this->redirectToRoute('admin_dessins_new');
        }

        return $this->render('BackEnd/dessins/new.html.twig', [
            'dessin' => $dessin,
            'form' => $form->createView(),
            'tousdessins'=>$tousDessins,
            'TBTitle' => 'Gestion des Dessins',
            'TBSuTitle' => 'Dessin',
            'TBCurrent' =>'Auteur'
        ]);
    }

    /**
     * @Route("/new/loky-old", name="admin_dessins_new_loky", methods={"GET","POST"})
     */
    public function locky(Request $request,DessinsRepository $dessinsRepository): Response
    {

       $tousLoky = $dessinsRepository->findBy(['genre'=>'loky'],['id'=>'Desc']);
        $dessin = new Dessins();
        $form = $this->createForm(LockyType::class, $dessin);
        $form->handleRequest($request);
//dd($tousLoky);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $dessin->setGenre('loky');
            $entityManager->persist($dessin);
            $entityManager->flush();

            $this->addFlash('success','Le dessin de loky a été bien enregistrée !');

            return $this->redirectToRoute('admin_dessins_new_loky');
        }

        return $this->render('BackEnd/dessins/loky.html.twig', [
            'dessin' => $dessin,
            'tousloky'=>$tousLoky,
            'form' => $form->createView(),
            'TBTitle' => 'Gestion des Dessins',
            'TBSuTitle' => 'Dessin',
            'TBCurrent' =>'Loky'
        ]);

    }

    /**
     * @Route("/new/{genre}", name="admin_dessins_new_dessin", methods={"GET","POST"})
     */
    public function BD(Request $request,DessinsRepository $dessinsRepository): Response
    {
        $genre = $request->get("genre");
       // dd($genre);
       $tousLoky = $dessinsRepository->findBy(['genre'=>$genre],['id'=>'Desc']);
        $dessin = new Dessins();
        $form = $this->createForm(LockyType::class, $dessin);
        $form->handleRequest($request);
//dd($tousLoky);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // On récupère les images transmises
            $images = $form->get('images')->getData();

            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('dessinateurs'),
                    $fichier
                );

                // On crée l'image dans la base de données

                $dessin1 = new Dessins();
                $dessin->setGenre($genre);
                $dessin1->setImages($fichier);
                $entityManager->persist($dessin1);

            }
            
            
            $entityManager->flush();

            $this->addFlash('success','La BD a été bien enregistrée !');

            return $this->redirectToRoute('admin_dessins_new_loky');
        }

        return $this->render('BackEnd/dessins/loky.html.twig', [
            'dessin' => $dessin,
            'tousloky'=>$tousLoky,
            'form' => $form->createView(),
            'TBTitle' => 'Gestion des Dessins',
            'TBSuTitle' => 'Dessin',
            'TBCurrent' => $genre
        ]);

    }


    /**
     * @Route("/{id}", name="admin_dessins_show", methods={"GET"})
     */
    public function show(Dessins $dessin): Response
    {
        return $this->render('BackEnd/dessins/show.html.twig', [
            'dessin' => $dessin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_dessins_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dessins $dessin): Response
    {
        $form = $this->createForm(DessinsType::class, $dessin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_dessins_index');
        }

        return $this->render('BackEnd/dessins/edit.html.twig', [
            'dessin' => $dessin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_dessins_delete", methods={"POST"})
     */
    public function delete(Request $request, Dessins $dessin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dessin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dessin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_dessins_index');
    }
}
