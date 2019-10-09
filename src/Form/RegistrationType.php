<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationType extends ApplicationType
{    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("Prénom", "Entrez votre prénom..."))
            ->add('lastName', TextType::class, $this->getConfiguration("Nom", "Entrez votre nom de famille..."))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "Entrez votre adresse email..."))
            ->add('picture', TextType::class, $this->getConfiguration("Photo de profil", "URL de votre avartar..."))
            ->add('hash',PasswordType::class, $this->getConfiguration("Mot de passe", "Entrez un mot de passe solide"))
            ->add('passwordConfirm',PasswordType::class, $this->getConfigurationPassWord("Confirmer le mot de passe", "Veuillez confirmer votre mot de passe","mdpNOTNULL()"))
            ->add('introduction',TextType::class, $this->getConfiguration("Introduction", "Présentez-vous rapidement..."))
            ->add('description',TextareaType::class, $this->getConfiguration("Description détaillé", "Présentez-vous de manière détaillé..."))
        ;
    }
//onkeydown="mdpNOTNULL()"
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
