<?php


namespace App\Controller\FrontEnd;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

/**
 * @Route("commande/panier/login")
 */
class IdentificationController extends AbstractController
{
    /**
     * @Route("/login", name="commande_panier_login")
     */
    public function login(Request $request,AuthenticationUtils $authenticationUtils,
                          UserPasswordEncoderInterface $passwordEncoder,SessionInterface $session): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $user = new User();
        $registrationForm = $this->createForm(RegistrationFormType::class, $user);
        $registrationForm->handleRequest($request);

        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $registrationForm->get('plainPassword')->getData()
                )

            );
            $user->setRoles(['ROLE_CLIENT']);
            $mail = $user->getEmail();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

           // $user = $session->get('user',[]);
            $session->set('user',  $user);
            // do anything else you need here, like send an email

            return $this->redirectToRoute('commande_chechkout_first');
        }


        return $this->render('FrontEnd/Accueil/commandes/identification.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'registrationForm' => $registrationForm->createView(),
        ]);
    }

    /**
     * @Route("/validation-commande", name="commande_validation")
     */
    public function paiement(SessionInterface $session) {
        $user =   $session->get('user',[]);

    }
}