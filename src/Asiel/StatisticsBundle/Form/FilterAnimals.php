<?php

namespace Asiel\StatisticsBundle\Form;

use Asiel\AnimalBundle\Form\MunicipalityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterAnimals extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('via', ChoiceType::class, [
                'label' => false,
                'multiple' => false,
                'expanded'  => false,
                'choices'   => [
                    'Beide'   => 'Both',
                    'Gevangen'    => 'Found_Caught',
                    'Afgestaan'    => 'Abandoned',
                ]
            ])
            ->add('datestart', DateType::class, [
                'label' => false,
            ])
            ->add('dateend', DateType::class, [
                'label' => false,
                'data'  => new \DateTime('today'),
            ])
            ->add('municipality', MunicipalityType::class, [
                'label' => false,
                'multiple' => true,
                'attr' => [
                    'size'=>'20'
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
            'mapped'    => false,
            'required'  => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'statisticsbundle_filter_animals';
    }
}
