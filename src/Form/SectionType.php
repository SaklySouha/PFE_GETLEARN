<?php

namespace App\Form;

use App\Entity\Section;
use App\Entity\Chapitre;
use Vich\UploaderBundle\Entity\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chapitre',EntityType::class,['class' => Chapitre::class,
            'choice_label' => 'titre',
            'label' => 'Chapitre' ])

            ->add('titre')
            ->add('descr',TextareaType::class)


            ->add('videoSection',FileType::class, [
                'required' => false,
            ])
            ->add('imagevSection',FileType::class, [
                'required' => false,
            ])
            ->add('fichierSection',FileType::class, [
                'required' => false,
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Section::class,
        ]);
    }
}
