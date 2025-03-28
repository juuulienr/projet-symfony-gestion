<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminTransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('amount', NumberType::class, [
            'attr' => [
                'class' => 'form-control',
                'autocomplete' => 'off',
            ],
        ])
        ->add('comment', TextareaType::class, [
            'attr' => [
                'class' => 'form-control',
                'autocomplete' => 'off',
            ],
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
