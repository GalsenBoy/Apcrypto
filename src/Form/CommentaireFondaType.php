<?php

namespace App\Form;

use App\Entity\CommentaireFonda;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentaireFondaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('actifFonda')
            ->add('nickname',TextType::class,[
                'label' => 'Pseudo',
                'attr' =>[
                    'class' => 'input'
               ]
            ])
            ->add('ContenuFonda',TextareaType::class,[
                'label' => 'Commentaire',
                'attr' =>[
                    'class' => 'textarea',
                    'style' => 'resize:none'
               ]
            ])
            //->add('date')
            //->add('analyseFondamentale')
            ->add('envoyer', SubmitType::class, [
                'label' => 'Commenter',
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
            'data_class' => CommentaireFonda::class,
        ]);
    }
}
