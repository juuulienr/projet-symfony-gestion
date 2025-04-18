<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('newPassword', PasswordType::class, [
            'label' => 'Nouveau mot de passe',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('confirmPassword', PasswordType::class, [
            'label' => 'Confirmer le mot de passe',
            'attr' => [
                'class' => 'form-control',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
