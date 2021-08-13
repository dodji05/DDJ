<?php

namespace App\Controller\Administration\Main;

use App\Entity\CategoriesArticles;
use App\Form\CategoriesArticlesType;
use App\Repository\CategoriesArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace-admin/articles")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/rubriques/", name="admin_rubrique_artilces_index", methods={"GET","POST"})
     */
    public function index(CategoriesArticlesRepository $categoriesArticlesRepository,Request $request): Response
    {
        $categoriesArticle = new CategoriesArticles();
        $form = $this->createForm(CategoriesArticlesType::class, $categoriesArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoriesArticle);
            $entityManager->flush();

            $this->addFlash(
                'succes',
                'La rubrique'.$categoriesArticle->getLibelle() .'a été ajoutée avec succes!'
            );

            return $this->redirectToRoute('admin_rubrique_artilces_index');
        }

        return $this->render('BackEnd/Main/articles/categorie/index.html.twig', [
            'categories_articles' => $categoriesArticlesRepository->findAll(),
            'categories_article' => $categoriesArticle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/rubrique/new", name="admin_rubrique_artilces_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoriesArticle = new CategoriesArticles();
        $form = $this->createForm(CategoriesArticlesType::class, $categoriesArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoriesArticle);
            $entityManager->flush();

            return $this->redirectToRoute('admin_rubrique_artilces_index');
        }

        return $this->render('BackEnd/Main/articles/categorie/new.html.twig', [
            'categories_article' => $categoriesArticle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/rubrique/{id}", name="admin_rubrique_artilces_show", methods={"GET"})
     */
    public function show(CategoriesArticles $categoriesArticle): Response
    {
//        return $this->render('BackEnd/Main/articles/show.html.twig', [
//            'categories_article' => $categoriesArticle,
//        ]);

        // $form = $this->createForm(RestaurantsType::class, $restaurant);

    }

    /**
     * @Route("/rubrique/{id}/edit", name="admin_rubrique_artilces_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategoriesArticles $categoriesArticle): Response
    {
//        $form = $this->createForm(CategoriesArticlesType::class, $categoriesArticle);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('admin_artilces_index');
//        }
//
//        return $this->render('BackEnd/Main/articles/edit.html.twig', [
//            'categories_article' => $categoriesArticle,
//            'form' => $form->createView(),
//        ]);

        $form = $this->createForm(CategoriesArticlesType::class, $categoriesArticle);

        if ($this->handleEditForm($request,$categoriesArticle ,$form)) {
            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(array(
                    'success' => true,
                ));
            } else {
//                return $this->redirectToRoute('app_autoecole_show', array('id' => $autoEcole->getId()));
                return $this->redirectToRoute('admin_rubrique_artilces_index');
            }
        }



        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'success' => false,
                'errors' => $form->getErrors(true),

            ]);
        }
        else {
            return $this->render('BackEnd/Main/articles/categorie/_form.html.twig', [
                'categories_article' => $categoriesArticle,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/rubrique/{id}", name="admin_rubrique_artilces_delete", methods={"POST"})
     */
    public function delete(Request $request, CategoriesArticles $categoriesArticle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriesArticle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoriesArticle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_rubrique_artilces_index');
    }

        /**
         * @Route("/rubrique/{id}/create-form", name="ajax_rubrique_article_edit",options={"expose"=true})
         */
        public function ajaxEditFormAction(Request $request, CategoriesArticles $categoriesArticles)
    {
        $editForm = $this->createForm(CategoriesArticlesType::class, $categoriesArticles);

        return $this->render('BackEnd/Main/articles/categorie/_form.html.twig', array(
            'categoriesArticles' => $categoriesArticles,
            'isModal' => true,
            'single' => true,
            'form' => $editForm->createView(),
        ));
    }

        public function handleEditForm(Request $request, $categoriesArticles, $form)
    {


        $form->handleRequest($request);

        $fake = true;


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //$entity = $form->getData();

            $em->persist($categoriesArticles);
            $em->flush();

            return true;
        }

        return false;
    }
}
