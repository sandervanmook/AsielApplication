<?php

namespace Asiel\LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Locatie Naam',
                'attr'  => [
                    'placeholder'   => 'Geef de locatie een naam'
                    ],
                'required'  => true,
            ])
            ->add('animalType', ChoiceType::class, [
                'label' => 'Geschikt voor',
                'required'  => true,
                'choices' => [
                    'Kat' => 'Cat',
                    'Hond' => 'Dog',
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
            'data_class' => 'Asiel\LocationBundle\Entity\Location'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_location';
    }


}
