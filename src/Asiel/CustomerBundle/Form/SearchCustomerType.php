<?php

namespace Asiel\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchCustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('query', TextType::class, [
                'label' => 'Zoek',
                'attr'      => [
                    'placeholder'   => 'Geef een zoekopdracht in'
                ],
                'required'  => true,
            ])
            ->add('searchon', ChoiceType::class, [
                'label' => 'op',
                'choices' => [
                    'Achternaam' => 'lastname',
                    'Adres'      => 'address'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Zoeken',
                'attr'  => [
                    'class' => 'btn btn-success'
                ]
            ])
            ->add('reset', ResetType::class, [
                'label' => 'Reset',
                'attr'  => [
                    'class' => 'btn-reset-customer-index btn btn-danger'
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
