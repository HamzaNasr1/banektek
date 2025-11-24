<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Reclamation;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ReclamationTypeClient extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Choisir un type' => '', // Placeholder option
                    'Problème de connexion' => 'probleme_connexion',
                    'Problème de transaction' => 'probleme_transaction',
                    'Problème de fonctionnalité' => 'probleme_fonctionnalite',
                    'Service client insatisfaisant' => 'service_client_insatisfaisant',
                    'Problème de sécurité' => 'probleme_securite',
                    'Problème technique' => 'probleme_technique',
                    'Autre' => 'autre',
                ],
            ])
            
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => 4], // Ajuster le nombre de lignes si nécessaire
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Champ obligatoire']),
                    new Assert\Length([
                        'min' => 10,
                        'minMessage' => 'La description doit comporter au moins {{ limit }} caractères',
                    ]),
                ]
            ])
            ->add('document', FileType::class, [
                'label' => 'Image',
                'required' => false, // Mettre à true si l'image est obligatoire
                'mapped' => false, // Ceci indique à Symfony de ne pas essayer de mapper ce champ à une propriété d'entité
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (jpeg, png, gif)',
                    ]),
                ]
            ])
            
            /*->add('id_client',EntityType::class, [
                'class' => Client::class,
                'placeholder' => "Id Client",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.id', 'ASC');
                },
                'choice_label' => 'id', // Change 'nom' to the actual property representing the author's name.
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
