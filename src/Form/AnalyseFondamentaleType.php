<?php

namespace App\Form;

use App\Entity\AnalyseFondamentale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnalyseFondamentaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actifName',TextType::class,[
                'label' => 'Nom de l\'actif',
                'attr' =>[
                    'class' => 'input'
               ]
            ])
            ->add('ExpliquationFond',TextareaType::class,[
                'label' => 'Analyse fondamentale',
                'attr' =>[
                    'class' => 'input',
                    'style' => 'resize:none'
               ]
            ])
            //->add('createat')
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
            'data_class' => AnalyseFondamentale::class,
        ]);
    }
}
