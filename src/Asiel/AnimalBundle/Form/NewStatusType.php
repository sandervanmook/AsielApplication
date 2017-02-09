<?php

namespace Asiel\AnimalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewStatusType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label'     => 'Wat is de nieuwe status',
                'mapped'    => false,
                'choices'       => [
                    'Terug naar eigenaar'   => 'ReturnedOwner',
                    'Overleden'             => 'Deceased',
                    'Kwijt'                 => 'Lost',
                    'Afgestaan'             => 'Abandoned',
                    'Gevonden'              => 'Found',
                    'In beslag genomen'     => 'Seized',
                ],
                'expanded'  => true,
                'multiple'  => false,
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
        return 'asielbundle_status';
    }


}
