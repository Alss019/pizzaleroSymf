<?php

namespace App\Form;

use App\Entity\Pizza;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CustomPizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {          
        $builder
            ->add('name_pizza')
            ->add('desc_pizza')
            ->add('price_pizza')
            ->add('img_pizza')
            ->add('ingredient')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
