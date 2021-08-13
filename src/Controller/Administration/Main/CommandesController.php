<?php


namespace App\Controller\Administration\Main;


use App\Entity\User;
use App\Repository\CommandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace-admin/commandes")
 */

class CommandesController extends AbstractController
{
    /**
     * @Route("/", name="admin_commandes_index", methods={"GET"})
     */
public function lesCommandes (CommandesRepository $commandesRepository){
    return $this->render('BackEnd/Main/commandes/list_commandes.html.twig', [
        'commandes' => $commandesRepository->touslesAchats(),
        'TBTitle' => 'Gestion des commandes',
        'TBSuTitle' => 'Commandes',
        'TBCurrent' =>'Toutes les commandes'

    ]);
}

    /**
     * @Route("/clients/{id}", name="admin_commandes_par_clients", methods={"GET"})
     */
public function commandesParClient(user $user, CommandesRepository $commandesrepository){
    $commandes = $commandesrepository->findBy(['user'=>$user],['DateCommande'=>'DESC']);
    return $this->render('BackEnd/Main/commandes/commandes_clients.html.twig', [
        'commandes' => $commandes,
        'TBTitle' => 'Gestion des commandes',
        'TBSuTitle' => 'Clients',
        'TBCurrent' => $user->getPrenom() . " ". $user->getNom()


    ]);
}
}