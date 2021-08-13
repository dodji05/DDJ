<?php


namespace App\Controller\FrontEnd;


use App\Entity\Articles;
use App\Entity\CategoriesArticles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/rubriques/{rubrique}/{Slug}", name="front_articles_show", methods={"GET"})
     */
    public function showArticles(Articles $articles): Response
    {
        return $this->render('FrontEnd/Articles/details_articles.html.twig', [
            'article' => $articles,
        ]);
    }

    /**
     * @Route("/articles/{slug}", name="front_categorie_articles_index", methods={"GET"})
     */
    public function index(CategoriesArticles $categoriesArticles): Response
    {
//        dd($categoriesArticles->getId());
        if($categoriesArticles->getId() == 1) {
            return $this->render('FrontEnd/Articles/le-dit-trop.html.twig', [
                'CategoriesArticles' => $categoriesArticles,
            ]);
        }
        return $this->render('FrontEnd/Articles/categorie_blog.html.twig', [
            'CategoriesArticles' => $categoriesArticles,
        ]);
    }

}