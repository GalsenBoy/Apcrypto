<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre e-mail',
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Votre pseudo',
                'attr' => [
                    'class' => 'input'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Votre pseudo ne peut pas être vide',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => ' Votre pseudo ne peut pas être inférieur à {{ limit }} caractères',
                        'max' => 100,
                    ]),
                ],
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Commentaire',
                'attr' => [
                    'class' => 'textarea',
                    'style' => 'resize:none'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => ' Le commentaire ne peut pas être vide',
                    ]),
                    new Length([
                        'min' => 25,
                        'minMessage' => ' Le commentaire ne peut pas être inférieur à {{ limit }} caractères',
                        'max' => 300,
                    ]),
                ],
            ])
            //->add('active')

            //->add('analysetechnique')
            ->add('commentaireParent', HiddenType::class, [
                'mapped' => false
            ])

            ->add('envoyer', SubmitType::class, [
                'label' => 'Commenter',
                'attr' => [
                    'class' => 'button is-link is-info',
                    'style' => 'margin-top:1rem'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
