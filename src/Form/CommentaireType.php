<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Form\Type\StarRatingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder        
        ->add('Contenu', null, [
            'constraints' => [
                new Assert\NotBlank(['message' => 'Contenu obligatoire']),
                new Assert\Length([
                    'min' => 3,
                    'minMessage' => 'Le commentaire doit comporter au moins {{ limit }} caractères',
                ]),
            ]
        ])
        ->add('note', StarRatingType::class, [
            'label' => false,
            'constraints' => [
                new Assert\NotBlank(['message' => 'Rating obligatoire']),
                ]
        ]);
           // ->add('date')
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
