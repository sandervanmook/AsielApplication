<?php

namespace Asiel\AnimalBundle\Form\StatusType;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReturnedOwnerType extends StatusType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('owner', HiddenType::class, [
                'mapped'     => false,

            ])
            ->add('search', TextType::class, [
                'label'         => 'Wie is de eigenaar',
                'mapped'        => false,
                'attr'          => [
                    'placeholder'  => 'Voer een achternaam in',
                ],
                'label_attr'    => [
                    'id'    => 'search',
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
            'data_class' => 'Asiel\AnimalBundle\Entity\StatusType\ReturnedOwner'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_statustype_returnedowner';
    }


}
