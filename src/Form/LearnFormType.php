<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LearnFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Saisissez votre nom', //contenu du libellé HTML défini dans <label></label>
                'required' => true, //place l'attribut required (champ requis) dans la balise input HTML
                'attr' => [ // les éléments définis ici se retrouve dans la balise HTML <input>
                    'class' => 'une_classe_bootstrap_par_exemple',
                    'id' => 'un_id',
                ],
            ])
            ->add('liste_choix', ChoiceType::class, [
                'label' => 'Aimez-vous les formulaires avec Symfony?',
                'choices' => [
                    'Oui!' => true, //'Oui' est la valeur affichée, et true est la valeur renvoyée
                                    // par le formulaire
                    'Non!' => false,
                ]
            ])
            ->add('valide', SubmitType::class, [
                'label' => 'Je valide',
                'attr' => [
                    'class' => 'btn btn-primary', //ex d'ajout de classes Bootstrap
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
