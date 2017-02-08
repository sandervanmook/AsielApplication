<?php

namespace Asiel\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookkeepingSettingsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * Entity properties are configured as int's, that's why we use scale 0
         */
        $builder
            ->add('priceAdoptedKitten', MoneyType::class, [
                'label' => 'Prijs adoptie kitten',
                'scale' => 0,
            ])
            ->add('priceAdoptedCat', MoneyType::class, [
                'label' => 'Prijs adoptie kat',
                'scale' => 0,
            ])
            ->add('priceAdoptedPuppy', MoneyType::class, [
                'label' => 'Prijs adoptie puppy',
                'scale' => 0,
            ])
            ->add('priceAdoptedDog', MoneyType::class, [
                'label' => 'Prijs adoptie hond',
                'scale' => 0,
            ])
            ->add('priceAbandonedKitten', MoneyType::class, [
                'label' => 'Prijs afstand kitten',
                'scale' => 0,
            ])
            ->add('priceAbandonedCat', MoneyType::class, [
                'label' => 'Prijs afstand kat',
                'scale' => 0,
            ])
            ->add('priceAbandonedPuppy', MoneyType::class, [
                'label' => 'Prijs afstand puppy',
                'scale' => 0,
            ])
            ->add('priceAbandonedDog', MoneyType::class, [
                'label' => 'Prijs afstand hond',
                'scale' => 0,
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\BackendBundle\Entity\BookkeepingSettings'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asiel_backendbundle_bookkeepingsettings';
    }


}
