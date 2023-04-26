<?php

namespace App\Form;

use App\Entity\Demande;
use App\Entity\Piece;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDemande', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('dateConfirmation', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('typeEchange')
            ->add('fraisTransport')
            ->add('modeTransport')
            ->add('numSerieAeronef')
            ->add('modeleAeronef')
            ->add('piece', EntityType::class, [
                'class' => Piece::class,
                'choice_label' => 'numSerie',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
