<?php


namespace App\Controller\FrontEnd;


use App\Entity\CommandeAbonnement;
use App\Entity\Commandes;
use App\Entity\LignesCommande;
use App\Entity\User;

use App\Repository\CommandesRepository;
use App\Repository\LignesCommandeRepository;


use App\Repository\ProduitsVariantsRepository;

use App\Repository\UneRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;


/**
 *
 * @Route("/commandes-parutions")
 */
class CommandeController extends AbstractController
{
    /**
     * @Route("/ajout-panier/{id}", name="ajout_panier")
     */
    public function ajout_panier($id, SessionInterface $session)
    {
//        $panier->ajout($id);
//        return $this->render('commmande/index.html.twig', [
//            'controller_name' => 'CommmandeController',
//        ]);

        $panier = $session->get('panier', []);
        //dd($id);
        if (empty($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }
        $session->set('panier', $panier);

        $session->set('paye',false);
        $this->addFlash('success', 'La parution a été ajoutée au panier');
        return $this->redirectToRoute('commmande_panier_affichage');
    }

    /**
     * @Route("/panier", name="commmande_panier_affichage")
     */
    public function panierAffichage(SessionInterface $session, ProduitsVariantsRepository $produitRepository, Request $request)
    {
//dd($request->getBasePath() );
        $panier = $session->get('panier', []);
        $panierdata = [];


        foreach ($panier as $id => $quantity) {
            $panierdata[] = [
                'produit' => $produitRepository->find($id),
                'quantite' => $quantity

            ];

        }
        //  dd($panierdata);

        $total = 0;
        foreach ($panierdata as $item) {
            $subtotal = (int)$item['produit']->getPrix() * $item['quantite'];
            $total += $subtotal;

        }

        return $this->render('FrontEnd/Accueil/panier-parution.html.twig', [
            'elements' => $panierdata,
            'total' => $total,


        ]);
    }

    /**
     * @Route("/paniers/ajout/{id}", name="cart_add")
     */
    public function addToCart($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);
        return $this->redirectToRoute('commmande_panier_affichage');
    }

    /**
     * @Route("/paniers/retrait/{id}", name="cart_remove")
     */
    public function removeToCart($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (($panier[$id]) > 1) {
            $panier[$id]--;
        } else {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
        return $this->redirectToRoute('commmande_panier_affichage');
    }

    /**
     * @Route("/cart/delete/{id}", name="cart_delete")
     */
    public function deleteCart($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
        return $this->redirectToRoute('commmande_panier_affichage');
    }

    /**
     * @Route("/validation/c/commande", name="commande_chechkout_first")
     */
    public function checkout2(SessionInterface $session, ProduitsVariantsRepository $produitRepository)
    {
        // $panier->ajout($id);

        $panier = $session->get('panier', []);
        $user = $session->get('user', []);


        $panierdata = [];
        foreach ($panier as $id => $quantity) {
            $panierdata[] = [
                'produit' => $produitRepository->find($id),
                'quantite' => $quantity

            ];

        }
        $total = 0;
        foreach ($panierdata as $item) {
            $subtotal = (int)$item['produit']->getPrix() * $item['quantite'];
            $total += $subtotal;

        }

        return $this->render('FrontEnd/Accueil/panier-parution-chechout.html.twig', [
            'elements' => $panierdata,
            'total' => $total,
//            'form' => $form->createView(),
        ]);


    }

    /**
     * @Route("/validation/commande", name="commande_chechkout")
     */
    public function checkout(Request $request, SessionInterface $session, ProduitsVariantsRepository $produitRepository,
                             MailerInterface $mailer,
                             CommandesRepository $commandesRepository)
    {
        // $panier->ajout($id);

        $panier = $session->get('panier', []);
        $user = $session->get('user', []);


        $panierdata = [];
        foreach ($panier as $id => $quantity) {
            $panierdata[] = [
                'produit' => $produitRepository->find($id),
                'quantite' => $quantity

            ];

        }
        $total = 0;
        foreach ($panierdata as $item) {
            $subtotal = (int)$item['produit']->getPrix() * $item['quantite'];
            $total += $subtotal;

        }


        if (!empty($user)) {

            $entityManager = $this->getDoctrine()->getManager();


            $commande = new Commandes();
            $totalcommande = 0 ;


            // enregistrement des produits de la commande
            foreach ($panier as $id => $quantity) {
                $product =   ($produitRepository->find($id));
                $lignescommande = new LignesCommande();
                $lignescommande->setCommande($commande);
                $lignescommande->setVariant($produitRepository->find($id));
                $lignescommande->setPrix($produitRepository->find($id)->getPrix());
                $lignescommande->setQuantite($quantity);
                $lignescommande->setTotal($produitRepository->find($id)->getPrix() * $quantity );
                $totalcommande += $produitRepository->find($id)->getPrix() * $quantity;

                    // s'il s'agit d'un abonnement
                if($product->getProduits()->getCategorie()->getId() == 2 ){
                    $abonnement = new CommandeAbonnement();
                    $abonnement->setTypeAbonnement($product->getProduits()->getNom())
                        ->setClient($user->getId())
                        ->setNbreNumeroRestant($product->getNbreNumero());
                    $entityManager->persist($abonnement);
                }

                $entityManager->persist($lignescommande);

            }

            //fin


//            $commande->setUser($user);
            $commande->setEtat('Encours');
            $commande->setClient($user->getId());
//            $entityManager->detach($user);
            $entityManager->persist($commande);

            $entityManager->flush();

            $session->set('commande_id', $commande->getId());
            $session->set('totalCommande', $total);


            return $this->redirectToRoute('commande_paiement_reglemement');

        }
        return $this->render('commmande/panier/checkout.html.twig', [
            'elements' => $panierdata,
            'total' => $total,

        ]);

//        return $this->redirectToRoute('commande_paiement');
    }

    /**
     * @Route("/paiement/reglement", name="commande_paiement_reglemement")
     */
    public function reglementkkiapay(SessionInterface $session,ProduitsVariantsRepository $produitRepository)
    {
        $panier = $session->get('panier', []);
        $panierdata = [];

        foreach ($panier as $id => $quantity) {
            $panierdata[] = [
                'produit' => $produitRepository->find($id),
                'quantite' => $quantity

            ];

        }
        $total = 0;
        foreach ($panierdata as $item) {
            $subtotal = (int)$item['produit']->getPrix() * $item['quantite'];
            $total += $subtotal;

        }

        return $this->render('FrontEnd/Accueil/commandes/kkiapay.html.twig', [
            'total_commande'=> $session->get('totalCommande', []),
            'elements' => $panierdata,
            'total' => $total,

        ]);
    }

    /**
     * @Route("/paiement/details-facture", name="commande_paiement")
     */
    public function facture(SessionInterface $session, LignesCommandeRepository $lignesCommandeRepository, CommandesRepository $commandesRepository, UserRepository $userRepository,MailerInterface $mailer)
    {

//        $idcommande = $session->get('commande_id', null);
        $idcommande = 12;
        $produits = $lignesCommandeRepository->findBy(['commande' => $idcommande]);
        $lacommande = $commandesRepository->find($idcommande);

        $panier = $session->get('panier', []);
        $user = $session->get('user', []);


        //

        $entityManager = $this->getDoctrine()->getManager();
//        $client = $entityManager->getRepository(User::class)->find($lacommande->getClient());
        $clientid= $lacommande->getClient();
    $client = $userRepository->findOneBy(["id"=>20]);

//         $lacommande->setUser($user);
//        $entityManager->persist($lacommande);
//        $entityManager->flush();

        //dd($panierdata);

        $total = 0;

        foreach ($produits as $item) {
            $subtotal = (int)$item->getPrix() * $item->getQuantite();
            $total += $subtotal;

        }
        $email = (new TemplatedEmail())
            ->from('ddj@ledechainedujeudi.com')
            ->to(new Address('commandes@ledechainedujeudi.com'))
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Nouvelle commande')

            // path of the Twig template to render
//            ->htmlTemplate('FrontEnd/Mails/nouvelle_commande.html.twig')
            ->htmlTemplate('FrontEnd/Mails/nouvelle_commande.html.twig')

            // pass variables (name => value) to the template
            ->context([

                'commande' => $lacommande,
                'client' => $user,
            ]);

       $mailer->send($email);

        $email_client = (new TemplatedEmail())
            ->from('ddj@ledechainedujeudi.com')
            ->to(new Address($client->getEmail()))
//            ->to(new Address('gildas31@gmail.com'))
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Confirmation de votre commande sur le déchaine du jeudi')

            // path of the Twig template to render
            ->htmlTemplate('FrontEnd/Mails/confirmation_achats.html.twig')

            // pass variables (name => value) to the template
            ->context([

                'commande' => $lacommande,
                'client' => $client
            ]);
        $mailer->send($email_client);
       // dd($mailer);
        if (!empty($panier)) {
            unset($panier);
            $session->remove("panier");
        }

        if (!empty($user)) {
            unset($user);
            $session->remove("user");
        }


        return $this->render('FrontEnd/Accueil/commandes/facture.html.twig', [
            'commande' => $produits,
            'total' => $total,
            'lacommande' => $lacommande,
            'client' => $user

        ]);
    }


}