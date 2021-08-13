<?php

namespace App\Controller\Administration\Main;

use App\Entity\Articles;
use App\Entity\CategoriesArticles;
use App\Form\ArticlesEditoType;
use App\Form\FlashNewsType;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace-admin/articles")
 */
class ArticlesRubriqueController extends AbstractController
{
    /**
     * @Route("/", name="admin_articles_index", methods={"GET"})
     */
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('BackEnd/Main/articles/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
            'TBTitle' => 'Gestion des articles',
            'TBSuTitle' => 'Articles',
            'TBCurrent' =>'Liste'

        ]);
    }

    /**
     * @Route("/new", name="admin_articles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash('success','L\'article a été bien enregistrée !');

            return $this->redirectToRoute('admin_articles_index');
        }

        return $this->render('BackEnd/Main/articles/new.html.twig', [
            'article' => $article,
            'headertitle'=>'Nouvel Article',
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/flash-news", name="admin_articles_flash_new", methods={"GET","POST"})
     */
    public function flashnew(Request $request): Response
    {
        $article = new Articles();
        $entityManager = $this->getDoctrine()->getManager();
        $article->setCategories($entityManager->getRepository(CategoriesArticles::class)->find(8));
        $form = $this->createForm(FlashNewsType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash('success','L\'article a été bien enregistrée !');

            return $this->redirectToRoute('admin_articles_index');
        }

        return $this->render('BackEnd/Main/articles/new.html.twig', [
            'article' => $article,
            'headertitle'=>'Flash News',
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/le-dit-trop", name="admin_articles_edito_new", methods={"GET","POST"})
     */
    public function edito(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = new Articles();
        $article->setCategories($entityManager->getRepository(CategoriesArticles::class)->find(1));
        $form = $this->createForm(ArticlesEditoType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success','Le dit trop a été bien enregistrée');

            return $this->redirectToRoute('admin_articles_index');
        }

        return $this->render('BackEnd/Main/articles/new.html.twig', [
            'article' => $article,
            'headertitle'=>'Le dit trop de Vianney',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_articles_show", methods={"GET"})
     */
    public function show(Articles $article): Response
    {
        return $this->render('BackEnd/Main/articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_articles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Articles $article): Response
    {
        if ($article->getCategories()->getId() == 8 ){
            $form = $this->createForm(FlashNewsType::class, $article);
        }
        elseif ($article->getCategories()->getId() == 1 ){
            $form = $this->createForm(ArticlesEditoType::class, $article);
        }
        else 
        {
            $form = $this->createForm(ArticlesType::class, $article);
        }   
      
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','L\'article a été modifiée avec succes !');
            return $this->redirectToRoute('admin_articles_index');
        }

        return $this->render('BackEnd/Main/articles/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_articles_delete", methods={"POST"})
     */
    public function delete(Request $request, Articles $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_articles_index');
    }
}
