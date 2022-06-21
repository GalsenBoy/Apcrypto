<?php

namespace App\Form;

use App\Entity\AnalyseTechnique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnalyseTechniqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actif',TextType::class,[
                'label' => "Nom de l'actif",
                'attr' => [
                    'class' => 'input',
                ]
            ])
            ->add('analyse',TextType::class,[
                'label' => "Lien vers tradingview",
                'attr' => [
                    'class' => 'input',
                ]
            ])
            ->add('explication',TextareaType::class,[
                'label' => "Plan de l'analyse",
                'attr' => [
                    'class' => 'textarea',
                ]
            ])
            //->add('date')
            ->add('envoyer', SubmitType::class, [
                'label' => 'Partager',
                'attr' => [
                    'class' => 'button is-link is-info',
                    'style' => 'margin-top:1rem'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnalyseTechnique::class,
        ]);
    }
}
