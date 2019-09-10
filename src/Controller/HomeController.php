<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller{
        /**
         *@Route("/bonjour", name="hello_base")
         *@Route("/bonjour/{prenom}", name="hello_prenom")
         *@Route("/bonjour/{prenom}/age/{age}", name="hello")
         *
         *Montre la page qui dit bonjour
         */
        public function hello($prenom = "anonyme",$age =14){
        return $this->render(
                'hello.html.twig',
                ['prenom' => $prenom,
                'age' => $age]);}
        
        
        /**
         *@Route("/",name="homepage")
         */
        public function home(){
                $prenom = ["lior" =>31, "Joseph"=>12, "Anne"=>55];
        return $this->render('home.html.twig',
        ['title' => "Au revoir",
        'age'=>31,
        'tableau' => $prenom
        ]);
        }
}
?>