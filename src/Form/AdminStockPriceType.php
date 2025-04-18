<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\StockList;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminStockPriceType extends AppType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, $this->getConfig('', 'Nom'))
        ->add('quantity', NumberType::class, $this->getConfig('', 'Quantité'));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StockList::class,
        ]);
    }
}
