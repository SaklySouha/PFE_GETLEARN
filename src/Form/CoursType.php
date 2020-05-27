<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Formation;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('imageCour',FileType::class, [
                'required' => false,
            ])
            ->add('formation',EntityType::class,['class' => Formation::class,
            'choice_label' => 'nom',
            'label' => 'Formation' ]);


        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
