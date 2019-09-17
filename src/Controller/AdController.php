<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Component\Routing\Annotation\Route;
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
