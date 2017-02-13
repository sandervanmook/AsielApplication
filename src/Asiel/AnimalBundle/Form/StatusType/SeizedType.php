<?php

namespace Asiel\AnimalBundle\Form\StatusType;

use Asiel\AnimalBundle\Form\MunicipalityType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeizedType extends StatusType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('municipality', MunicipalityType::class, [
                'label' => 'In welke gemeente in beslag genomen',
            ])
            ->add('amountpeople', ChoiceType::class, [
                'label' => 'Met hoeveel mensen aanwezig',
                'choices' => [
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                ],
            ])
            ->add('timespend', NumberType::class, [
                'label' => 'Hoeveel uur tijd besteed',
                'scale' => 0,
            ])
            ->add('medicalactions', CKEditorType::class, [
                'label' => 'Medische ingrepen',
            ])
            ->add('totalcosts', MoneyType::class, [
                'label' => 'Totale kosten',
                'scale' => 0,
                // Total costs are saved in the action/
                'mapped' => false,
            ])
        ;
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\AnimalBundle\Entity\StatusType\Seized'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'animalbundle_statustype_seized';
    }


}
