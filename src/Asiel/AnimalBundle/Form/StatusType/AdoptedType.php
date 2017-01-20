<?php

namespace Asiel\AnimalBundle\Form\StatusType;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdoptedType extends StatusType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('price', IntegerType::class, [
                'label'         => 'Hoeveel is er betaald voor het dier',
                'attr'          => [
                    'placeholder'   => 'Vul het bedrag in wat er voor het dier is betaald'
                ]

            ])
            ->add('search', TextType::class, [
                'label'         => 'Geadopteerd door',
                'mapped'        => false,
                'attr'          => [
                    'placeholder'  => 'Voer een achternaam in',
                ],
                'label_attr'    => [
                    'id'    => 'search',
                ]
            ])
            ->add('customer', HiddenType::class, [
                'mapped'        => false,
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\AnimalBundle\Entity\StatusType\Adopted'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_statustype_adopted';
    }


}
