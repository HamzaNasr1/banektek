<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Agent;
//use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresse', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Adresse obligatoire']),
                    
                ]
            ])
            ->add('nom', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Nom obligatoire']),
                    
                ]
            ])
            ->add('num_tel', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Num tel obligatoire']),
                    new Assert\Length([
                        'min' => 8,
                        'minMessage' => 'Le num doit comporter au moins {{ limit }} caractères',
                    ]),
                ]
            ])
            ->add('longitude', null, [
                
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Num tel obligatoire']),
                   
                ]
            ])
            ->add('latitude', null, [
              
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Num tel obligatoire']),
                 
                ]
            ])

            ->add('id_chef', EntityType::class, [
                'class' => Agent::class,
                'placeholder' => "Chef d'agence",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->where('a.id_agence IS NULL') // Fetch only agents without an associated agency
                        ->orderBy('a.id', 'ASC');
                },
                'choice_label' => function (Agent $agent) {
                    return $agent->getNom()." ".$agent->getPrenom()." - ".$agent->getId();
                },
                'required' => false,
            ])
            
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agence::class,
        ]);
    }
}

/*
>add('date_transaction')
            ->add('montant')
            ->add('id_compte',EntityType::class, [
                'class' => Compte::class,
                'placeholder' => "Compte emetteur",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.id', 'ASC');
                },
                'choice_label' => function (Compte $compte) {
                    // Assuming 'client' is the property in Compte entity that references the Client entity.
                    // Adjust this based on your actual entity structure.
                    return $compte->getIdUser()->getNom()." ".$compte->getIdUser()->getPrenom()."-".$compte->getIdUser()->getId();
                },
            ])
        
  ;  }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}

*/