<?php


namespace App\Controller\Administration\Main;


use App\Repository\CommandeAbonnementRepository;
use App\Repository\CommandesRepository;
use App\Repository\LignesCommandeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace-admin")
 */
class TableauBordController extends AbstractController
{
    /**
     * @Route("/", name="TB_index")
     */
    public function index(Request $request,UserRepository $user,
                          LignesCommandeRepository $lignecommande,
    CommandeAbonnementRepository $abonnementRepository, CommandesRepository $commandes): Response
    {
        $vente = $lignecommande->totalVente();
        $client = sizeof($user->findAll());
        $abonnes = $abonnementRepository->totalAbonnes();
        $nbvisite =3 ;

        $nouveauClients = $user->nouveauxClients(5);
        $derniersAchat = $commandes->derniersAchats(5);
        return $this->render('BackEnd/Main/index.html.twig',[
            "ventes"=>$vente,
            "clients"=>$client,
            "abonnes"=>$abonnes,
            "nbreVisite"=>$nbvisite,
            "nouveaux"=>$nouveauClients,
            "achats"=>$derniersAchat

        ]);
    }
}