<?php

namespace App\Form;

use App\Entity\AnalyseFondamentale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnalyseFondamentaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actifName', TextType::class, [
                'label' => 'Nom de l\'actif',
                'attr' => [
                    'class' => 'input'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => ' Veuillez entrer le nom l\'actif ',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nom de l\'actif ne doit pas être inférieur à {{ limit }} caractères',
                        'max' => 100,
                    ]),
                ],
            ])
            ->add('ExpliquationFond', TextareaType::class, [
                'label' => 'Analyse fondamentale',
                'attr' => [
                    'class' => 'textarea',
                    'style' => 'resize:none'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => ' L\'explication de l\'analyse ne doit pas être vide',
                    ]),
                    new Length([
                        'min' => 25,
                        'minMessage' => ' L\'explication de l\'analyse ne peut pas être inférieur à {{ limit }} caractères',
                        'max' => 300,
                    ]),
                ],
            ])
            //->add('createat')
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
            'data_class' => AnalyseFondamentale::class,
        ]);
    }
}
