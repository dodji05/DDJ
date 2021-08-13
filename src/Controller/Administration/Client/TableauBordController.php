<?php


namespace App\Controller\Administration\Client;




use App\Entity\Produits;
use App\Entity\ProduitsVariants;
use App\Repository\CommandesRepository;
use App\Repository\LignesCommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nom-espace")
 */
class TableauBordController extends AbstractController
{
    /**
     * @Route("/", name="TB_index_client")
     */
    public function index(Request $request): Response
    {
        return $this->render('BackEnd/Clients/index.html.twig');
    }


    /**
     * @Route("/mes-abonnements", name="TB_client_abonnements")
     */
    public function mesAbonnements(Request $request): Response
    {
        return $this->render('BackEnd/Clients/index.html.twig');
    }

    /**
     * @Route("/mes-dechaines", name="TB_client_dechaines")
     */
    public function mesdechaines(Request $request, CommandesRepository $commandesRepository): Response
    {
        $mesdechaines = $commandesRepository->findBy(['Client'=>$this->getUser()->getId()]);
//        dd($mesdechaines);
//$this->u
        return $this->render('BackEnd/Clients/mesdechaines.html.twig',[
            'mesdechaines' => $mesdechaines
            ]
    );
    }

    /**
     * @Route("/nom-dechaines/{slug}", name="TB_client_lecture")
     */
    public function lire(Request $request, ProduitsVariants $produits): Response
    {
//        $mesdechaines = $commandesRepository->findBy(['id'=>1]);
//        dd($mesdechaines);

        return $this->render('BackEnd/Clients/lecture.html.twig',[
                'parution' => $produits
            ]
        );
    }



}
