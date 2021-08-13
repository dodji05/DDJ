<?php


namespace App\Services\Panier;


use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
  protected  $session;

    /**
     * PanierService constructor.
     * @param $session
     */
    public function __construct( SessionInterface $session)
    {
        $this->session = $session;
    }

    public function ajout(int $id){

    $panier = $this->session->get('panier',[]);
    //dd($id);
        if (empty($panier[$id])){
            $panier[$id] = 1 ;
        }
        else{
            $panier[$id]++;
        }

    $this->session->set('panier',$panier);
   // dd( $this->session->get('panier'));
    }


}