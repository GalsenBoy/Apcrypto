<?php

namespace App\Form;

use App\Entity\AnalyseTechnique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnalyseTechniqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actif', TextType::class, [
                'label' => "Nom de l'actif",
                'attr' => [
                    'class' => 'input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom de l\'actif ne doit pas être vide',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nom de l\'actif ne peut pas être inférieur à {{ limit }} caractères',
                        'max' => 300,
                    ]),
                ],
            ])
            ->add('analyse', TextType::class, [
                'label' => "Lien vers tradingview",
                'attr' => [
                    'class' => 'input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champ de l\'url ne doit pas être vide',
                    ])
                ]
            ])
            ->add('explication', TextareaType::class, [
                'label' => "Plan de l'analyse",
                'attr' => [
                    'class' => 'textarea',
                    'style' => 'resize:none'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le plan de l\'analyse ne doit pas être vide',
                    ]),
                    new Length([
                        'min' => 25,
                        'minMessage' => 'Le plan de l\'analyse ne peut pas être inférieur à {{ limit }} caractères',
                        'max' => 300,
                    ]),
                ],
            ])
            //->add('date')
            ->add('envoyer', SubmitType::class, [
                'label' => 'Partager',
                'attr' => [
                    'class' => 'button is-link is-info',
                    'style' => 'margin-top:1rem'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnalyseTechnique::class,
        ]);
    }
}
