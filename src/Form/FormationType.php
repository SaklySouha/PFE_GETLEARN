<?php

namespace App\Form;
use App\Entity\Category;
use App\Entity\Cours;
use App\Entity\Formateur;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('date')
            ->add('prix')
            ->add('cour', EntityType::class,['class' => Cours::class,
                'choice_label' => 'titre',
                'label' => 'Cour'  ])
            ->add('category',EntityType::class,['class' => Category::class,
                                            'choice_label' => 'titre',
                                            'label' => 'Category'  ])

           ->add('formateur',EntityType::class,['class' => Formateur::class,
                                            'choice_label' => 'nomf' ,
                                            'label' => 'Formateur'
                                            ])
           ->add('descr',TextareaType::class)

            ->add('imageFormation',FileType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
