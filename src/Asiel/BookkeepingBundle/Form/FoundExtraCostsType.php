<?php

namespace Asiel\BookkeepingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FoundExtraCostsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sterilization', MoneyType::class, [
                'label' => 'Kosten sterilisatie',
                'scale' => 2,
                'data' => 0,
            ])
            ->add('medical', MoneyType::class, [
                'label' => 'Medische kosten',
                'scale' => 2,
                'data' => 0,
            ])
            ->add('damage', MoneyType::class, [
                'label' => 'Kosten door schade',
                'scale' => 2,
                'data' => 0,
            ])
            ->add('tenancydays', ChoiceType::class, [
                'label' => 'Aantal dagen bij ons verbleven',
                'choices' => [
                    0 => 0,
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                    6 => 6,
                    7 => 7,
                    8 => 8,
                    9 => 9,
                    10 => 10,
                    11 => 11,
                    12 => 12,
                    13 => 13,
                    14 => 14,
                ]
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asiel_bookkeepingbundle_found_extra_costs';
    }


}
