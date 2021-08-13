<?php

namespace App\Controller\FrontEnd;



use App\Entity\CategoriesArticles;
use App\Entity\Equipe;
use App\Entity\Produits;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesArticlesRepository;
use App\Repository\DessinsRepository;
use App\Repository\EquipeRepository;
use App\Repository\ProduitsRepository;
use App\Repository\SliderRepository;
use App\Repository\UneRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Liip\ImagineBundle\Imagine\Cache\CacheManager as ImageCache;
class AccueilController  extends AbstractController
{
    /**
     * @Route("/", name="accueil_index")
     *
     */
    public function index(Request $request, UneRepository $uneRepository, SliderRepository $sliderRepository,
                          CategoriesArticlesRepository $categoriesArticles, ProduitsRepository $produitsRepository, ArticlesRepository $articlesRepository): Response
    {
        $la_une = $uneRepository->findBy([],['id' => 'desc'],1,0)[0];
        $slides = $sliderRepository->findBy(['active'=>'true']);
        $rubrique = $categoriesArticles->findAll();
        $derniersParutions = $produitsRepository->findBy(["Categorie"=>1],['id' => 'desc'],4,0);
        $derniersArticles = $articlesRepository->recentsarticles(6);
        $flashnews = $articlesRepository->findBy(['categories'=>8],['id' => 'desc'],5,0);

//        $imagineCacheManager = $this->get('liip_imagine.cache.manager');
//       $resolvedPath = $imagineCacheManager->getBrowserPath('$la_une->getImagesUne()', 'laUne');
        return $this->render('FrontEnd/Accueil/index.html.twig',
        [
            'une'=>$la_une,
            'slides'=>$slides,
            'parutions'=>$derniersParutions,
            'articles'=>$derniersArticles,
            'rubrique'=>$rubrique,
            'flashnews'=>$flashnews

        ]);
    }
    /**
     * @Route("/envoi-dessins", name="accueil_envoi_dessins")
     *
     */
    public function dessin(Request $request) {
        return $this->render('FrontEnd/envoi-dessins.html.twig');

    }

    /**
     * @Route("/l-equipe", name="accueil_equipe")
     *
     */
    public function equipe(Request $request, EquipeRepository $equipeRepository) {
        return $this->render('FrontEnd/equipe.html.twig',[
            'membres'=>$equipeRepository->findAll(),
        ]);

    }

    /**
     * @Route("/nos-dessinateurs", name="accueil_equipe_dessinateurs")
     *
     */
    public function equipeDesinatuers(EquipeRepository $equipeRepository) {
        return $this->render('FrontEnd/nos-dessinateurs.html.twig',[
        'membres'=>$equipeRepository->findBy(['role'=>'dessinateurs']),
        ]);

    }

    /**
     * @Route("/nos-dessinateurs/{nom}", name="accueil_dessin_dessinateurs")
     *
     */
    public function dessinsDesinatuers(Request $request,DessinsRepository $dessinsRepository, Equipe $dessinateur,  PaginatorInterface $paginator) {

        $dessins = $paginator->paginate(
            $dessinsRepository->findBy(['auteur'=>$dessinateur]), // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            15 // Nombre de résultats par page
        );

        return $this->render('FrontEnd/dessins.html.twig',[
            'dessins'=>$dessins,
            'auteur'=>$dessinateur
        ]);

    }

    /**
     * @Route("/lokyspehre", name="accueil_univers_loky")
     *
     */
    public function lokysohere(DessinsRepository $dessinsRepository) {
        $lokies = $dessinsRepository->findBy(['genre' =>'loky'],['id' => 'desc']);


        return $this->render('FrontEnd/lokysphere.html.twig',[
            'lokies'=>$lokies,
        ]);

    }
    /**
     * @Route("/coin-bede", name="accueil_univers_bd")
     *
     */
    public function coinBD(DessinsRepository $dessinsRepository) {
        $lokies = $dessinsRepository->findBy(['genre' =>'coinBD'],['id' => 'desc']);


        return $this->render('FrontEnd/coinbd.html.twig',[
            'lokies'=>$lokies,
        ]);

    }
    /**
     * @Route("/derniere-parution", name="accueil_derniers_parution")
     *
     */
    public function derniereParution(ProduitsRepository $produitsRepository) {
        $dernierParution = $produitsRepository->findBy(["Categorie"=>1],['id' => 'desc'],1,0)[0];


        return $this->render('FrontEnd/derniere-parution.html.twig',[
            'parution'=>$dernierParution,
        ]);

    }

    /**
     * @Route("/acheter-au-numero/parution/{Nom}", name="accueil_achat_parution")
     *
     */
    public function uneParution(Produits $produits) {
//        $dernierParution = $produitsRepository->findBy(["Categorie"=>1],['id' => 'desc'],1,0)[0];


        return $this->render('FrontEnd/derniere-parution.html.twig',[
            'parution'=>$produits,
        ]);

    }

    /**
     * @Route("/acheter-au-numero", name="accueil_boutique_parutions")
     *
     */
    public function boutiqueParutions(ProduitsRepository $produitsRepository) {
        $lesParution = $produitsRepository->findBy(["Categorie"=>1],['id' => 'desc']);


        return $this->render('FrontEnd/boutique.html.twig',[
            'parutions'=>$lesParution,
        ]);

    }
    /**
     * @Route("/archives", name="accueil_achives_parutions")
     *
     */
    public function archives(ProduitsRepository $produitsRepository) {
        $lesParution = $produitsRepository->findBy(["Categorie"=>1],['id' => 'desc']);


        return $this->render('FrontEnd/boutique.html.twig',[
            'parutions'=>$lesParution,
        ]);

    }
    /**
     * @Route("/formules-abonnement", name="accueil_formules_abonnement")
     *
     */
    public function formulesAbonnement() {
//        $lesParution = $produitsRepository->findBy(["Categorie"=>1],['id' => 'desc']);


        return $this->render('FrontEnd/formules-abonnement.html.twig',[

        ]);

    }


}