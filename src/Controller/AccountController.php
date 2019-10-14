<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * Affiche + gere form connexion
     * 
     * @Route("/login", name="account_login")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error= $utils->getLastAuthenticationError();
        $username= $utils->getLastUsername();
        return $this->render('account/login.html.twig',[
        'hasError' => $error !== null,
        'username' => $username
        ]);
    }
   
    /**
     * Deconnecte
     *
     * @Route("/logout", name="account_logout")
     * 
     * @return void
     */
    public function logout(){
        //rien
    }

    /**
     * affiche form register
     * 
     * @Route("/register", name="account_register")
     * 
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $user= new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $hash=$encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success','Votre compte a bien été créé'
            );
            return $this->redirectToRoute("account_login");
        }
        return $this->render('account/registration.html.twig',[
            'form'=> $form->createView()
        ]);
    }
    /**
     * Permet d'afficher et de traiter form modif
     * 
     * @Route("/account/profile", name="account_profile")
     * @return Response
     */
    public function profile(Request $request, ObjectManager $manager)
    {
        $user=$this->getUser();
        $form=$this->createForm(AccountType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($user);
            $manager->flush();
            
            $this->addFlash('success', "Les données du profil ont été enregistrée avec ssuccès !");
            return $this->redirectToRoute("account_login");

                }
        return $this->render('account/profile.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    /**
     * Modif mdp
     *
     * @Route("/account/password-update", name="account_password")
     * @return Reponse
     */
    public function updatePassword(){
        return $this->render('account/password.html.twig');
    }
}
