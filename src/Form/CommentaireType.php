<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'label' => 'Votre e-mail',
                'attr' =>[
                     'class' => 'input'
                ]
            ])
            ->add('pseudo',TextType::class,[
                'label' => 'Votre pseudo',
                'attr' =>[
                    'class' => 'input'
               ]
            ])
            ->add('contenu',TextareaType::class,[
                'label' => 'Commentaire',
                'attr' =>[
                    'class' => 'input',
                    'style' => 'resize:none'
                ]
            ])
            //->add('active')
            
            //->add('analysetechnique')
            ->add('commentaireParent',HiddenType::class,[
                'mapped' => false
            ])
            
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
            'data_class' => Commentaire::class,
        ]);
    }
}
