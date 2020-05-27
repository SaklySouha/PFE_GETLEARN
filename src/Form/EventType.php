<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Category;
use App\Entity\Formateur;
use Vich\UploaderBundle\Entity\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('TitreE')
            ->add('AdresseE')
            ->add('DateE')
            ->add('HeureE')
            ->add('DescrE')
            ->add('category',EntityType::class,['class' => Category::class,
            'choice_label' => 'titre'  ,
            'label' => 'Catégorie'])
            ->add('formateur',EntityType::class,['class' => Formateur::class,
            'choice_label' => 'nomf'  ,
            'label' => 'Formateur'])
            ->add('imageEvent',FileType::class, [
                'required' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
