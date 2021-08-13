<?php


namespace App\Controller\FrontEnd;


use App\Entity\Produits;
use App\Entity\TypeAbonnement;
use App\Repository\DetailsAbonnementRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/abonnement")
 */
class AbonnementController extends AbstractController
{
    /**
     * @Route("/{slug}", name="accueil_abonnement")
     *
     */
 public function abonnement (Request $request,Produits $produits)
 {




     return $this->render('FrontEnd/Accueil/details_abonnement.html.twig', [
         'produit' =>  $produits,

     ]);
 }

    /**
     * @Route("c/panier", name="accueil_abonnement_etape1")
     *
     */
 public function  etape1 (Request $request,DetailsAbonnementRepository $detailsAbonnementRepository,SessionInterface $session ){
//     dd($request->request->get('abonnement'));
     $id = $request->request->get('abonnement');
     $panier = $session->get('panier',[]);
     //dd($id);
     if (empty($panier[$id])){
         $panier[$id] = 1 ;
     }
     else{
         $panier[$id]++;
     }
     $session->set('panier',$panier);
     $this->addFlash('success', 'La parution a été ajoutée au panier');
     return $this->redirectToRoute('commmande_panier_affichage');
    /* return $this->render('FrontEnd/Accueil/panier-3.html.twig', [
             'abonnement' =>  $abonnement,
//         'form' => $form->createView(),
     ]
     );*/

 }
}