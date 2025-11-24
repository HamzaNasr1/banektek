<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Article;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Champ obligatoire']),
                    new Assert\Length([
                        'min' => 5,
                        'minMessage' => 'Le titre doit comporter au moins {{ limit }} caractères',
                    ]),
                ]
            ])
            ->add('contenu', TextareaType::class, [
                'attr' => ['rows' => 8], // Adjust the number of rows as needed
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Champ obligatoire']),
                    new Assert\Length([
                        'min' => 50,
                        'minMessage' => 'Le contenu doit comporter au moins {{ limit }} caractères',
                    ]),
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => false, // Set to true if the image is mandatory
                'mapped' => false, // This tells Symfony not to try to map this field to any entity property
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez saisir une image']),
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
            ->add('id_agent', EntityType::class, [
                'class' => Agent::class,
                'placeholder' => "Chef d'agence",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.id', 'ASC');
                },
                'choice_label' => 'nom', // Change 'nom' to the actual property representing the author's name.
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Champ obligatoire']),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
