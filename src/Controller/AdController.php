<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Image;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo)
    {
       // $repo = $this->getDoctrine()->getRepository(Ad::class);
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads]);
    }


    /**
     * Permet de cree une annonce
     *
     * @Route("/ads/new", name="ads_create")
     * 
     * @return Reponse
     */
    public function create(Request $request, ObjectManager $manager){
        $ad=new Ad();
        $image= new Image();
        $image->setUrl('http://placehold.it/400x200')
              ->setCaption('Titre1');
        
        $image2= new Image();
        $image2->setUrl('http://placehold.it/400x200')
        ->setCaption('Titre2');

        $ad->addImage($image)
            ->addImage($image2);

        $form = $this->CreateForm(AdType::class, $ad);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($ad);
            $manager->flush();
            $this->addFlash(
                "success","L'annonce <strong>{$ad->getTitle()}</strong> a bien été enregistrée !"
            );
            return $this->redirectToRoute('ads_show',[
                'slug' => $ad->getSlug()
            ]);
        }

        return $this->render('ad/create.html.twig',[
            'form' => $form->createView()
            ]);
    }
    /**
     * Permet d'afficher une seule annonce
     *
     * @Route("ads/{slug}",name="ads_show")
     * @return Reponse
     */
    public function show(Ad $ad)
    {
        //je recupere l'annonce par le slug
        //$ad=$repo->findOneBySlug($slug);

        return $this->render('ad/show.html.twig',['ad'=>$ad]);
    }

}

