<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Reclamation;
use App\Entity\Reponse;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReponseType extends AbstractType
{


 
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      
        $builder
            
        ->add('message', TextareaType::class, [
            'attr' => ['rows' => 8], // Adjust the number of rows as needed
        ])
        

 ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
        ]);
    }
 
}
