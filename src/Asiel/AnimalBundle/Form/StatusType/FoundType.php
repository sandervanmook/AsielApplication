<?php

namespace Asiel\AnimalBundle\Form\StatusType;

use Asiel\AnimalBundle\Form\MunicipalityType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FoundType extends StatusType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('foundType', ChoiceType::class, [
                'label' => 'Hoe is het dier binnengekomen',
                'choices' => [
                    'Door ons gevangen' => 'Door ons gevangen',
                    'Vondeling' => 'Vondeling',
                    'Politie' => 'Politie',
                    'Zwerfproject' => 'Zwerfproject',
                ]
            ])
            ->add('foundMunicipality', MunicipalityType::class, [
                'label' => 'Gevonden in gemeente',
            ])
            ->add('foundAtLocation', CKEditorType::class, [
                'label' => 'Waar is het dier gevonden'
            ])
            ->add('animalState', CKEditorType::class, [
                'label' => 'De staat waarin het dier verkeerde'
            ])
            ->add('needsChipping', CheckboxType::class, [
                'label' => 'Moet door ons gechipt worden',
                'required' => false,
            ])
            ->add('needsDeWorm', CheckboxType::class, [
                'label' => 'Moet door ons ontwormt worden',
                'required' => false,
            ])
            ->add('needsVaccines', CheckboxType::class, [
                'label' => 'Moet door ons gevaccineerd worden',
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\AnimalBundle\Entity\StatusType\Found'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'animalbundle_statustype_found';
    }


}
