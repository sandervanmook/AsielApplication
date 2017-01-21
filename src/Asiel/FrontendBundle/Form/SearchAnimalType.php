<?php

namespace Asiel\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchAnimalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'Type',
                'choices' => [
                    'Kat'        => 'Cat',
                    'Dog'        => 'Dog',
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Geslacht',
                'choices' => [
                    'Mannelijk'   => 'Male',
                    'Vrouwelijk'  => 'Female',
                ],
            ])
            ->add('age', ChoiceType::class, [
                'label' => 'Leeftijd',
                'choices' => [
                    'Pup/Kitten'        => '0',
                    '1-2 jaar'          => '1',
                    '2 jaar en ouder'   => '2',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Zoeken',
                'attr'  => [
                    'class' => 'btn btn-default',
                    'id'    => 'submit'
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
            'required'  => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_search';
    }


}
