<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdminRegistrationType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
    ->add('firstName', TextType::class, [
      'attr' => [
        'class' => 'form-control',
        'autocomplete' => 'off'
      ]])
    ->add('email', EmailType::class, [
      'attr' => [
        'class' => 'form-control',
        'autocomplete' => 'off'
      ]])
    ->add('role', ChoiceType::class, [
      'attr' => [
        'class' => 'form-control',
        'autocomplete' => 'off'
      ],
      'choices'  => [
        'ROLE_LIVREUR' => 'ROLE_LIVREUR',
        'ROLE_EMPLOYÉ' => 'ROLE_EMPLOYÉ',
        'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
      ],
      'placeholder' => 'Selectionner un rôle'
    ])
    ->add('hash', PasswordType::class, [
      'attr' => [
        'class' => 'form-control',
        'autocomplete' => 'off'
      ]
    ])
    ->add('passwordConfirm', PasswordType::class, [
      'attr' => [
        'class' => 'form-control',
        'autocomplete' => 'off'
      ]
    ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Admin::class,
    ]);
  }
}
