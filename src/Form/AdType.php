<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends ApplicationType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, $this->getConfiguration("Titre","Tapez un titre pour votre annonce"))
            ->add('slug',TextType::class,$this->getConfiguration("Adresse web", "tapez l'adresse web (automatique)"))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Donnez une description globale"))
            ->add('content',  TextareaType::class, $this->getConfiguration("Description","Tapez une description qui donne en vie devenir chez vous"))
            ->add('coverImage', UrlType::class, $this->getConfiguration("URL de l'iamge principale", "Donnez l'adresse d'une image qui donne envie de venir chez vous"))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix par nuit", "Indiquez le prix par nuit"))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambre", 'Le nombre de chambre disponible'))
            ->add('images', CollectionType::class,
            [
                'entry_type' => ImageType::class,
                'allow_add' => true
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
