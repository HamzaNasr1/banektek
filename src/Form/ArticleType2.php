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

class ArticleType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, [
               
            ])
            ->add('contenu', TextareaType::class, [
                'attr' => ['rows' => 8], // Adjust the number of rows as needed
                
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => false, // Set to true if the image is mandatory
                'mapped' => false, // This tells Symfony not to try to map this field to any entity property
                
                    
                
            ])
          ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
