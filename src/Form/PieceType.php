<?php

namespace App\Form;

use App\Entity\Piece;
use App\Entity\TypePiece;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PieceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numSerie')
            ->add('dateFabrication', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('prix')
            ->add('etat')
            ->add('siteStockage')
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Neuf' => 'Neuf',
                    'Occasion' => 'Occasion',
                    'Neuf-réparé' => 'Neuf-réparé',
                ],
                'placeholder' => 'Choisir un état',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Piece::class,
        ]);
    }
}
