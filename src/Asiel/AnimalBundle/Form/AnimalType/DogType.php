<?php

namespace Asiel\AnimalBundle\Form\AnimalType;

use Asiel\AnimalBundle\Form\AnimalType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogType extends AnimalType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('race', TextType::class, [
                'label'     => 'Ras',
                'required'  => false,
                'attr'          => [
                    'placeholder'   => 'Van welk ras is het dier'
                ]
            ])
            ->add('knownCommands', CKEditorType::class, [
                'label'     => 'Welke commando\'s snapt de hond',
                'required'  => false,
            ])
            ->add('needsExercise', CheckboxType::class, [
                'label'     => 'Heeft de hond beweging nodig ?',
                'required'  => false,
            ])
            ->add('furType', TextType::class, [
                'label'     => 'Type vacht',
                'required'  => false,
                'attr'          => [
                    'placeholder'   => 'Wat is het type vacht'
                ]
            ])
            ->add('sterilized', CheckboxType::class, [
                'label'     => 'Gesteriliseerd / Gecastereerd',
                'required'  => false,
            ])
            ->add('compatibleSmallDog', CKEditorType::class, [
                'label'     => 'Kan het dier met kleine honden overweg ?',
                'required'  => false,
            ])
            ->add('compatibleLargeDog', CKEditorType::class, [
                'label'     => 'Kan het dier met grote honden overweg ?',
                'required'  => false,
            ])
            ->add('compatibleCat', CKEditorType::class, [
                'label'     => 'Kan samen met katten ?',
                'required'  => false,
            ])
            ->add('compatibleOtherAnimals', CKEditorType::class, [
                'label'     => 'Kan het met andere dieren overweg ?',
                'required'  => false,
            ])
            ->add('toiletTrained', CheckboxType::class, [
                'label'     => 'Zindelijk',
                'required'  => false,
            ])
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
            )
        ;
    }

    /**
     * @param FormEvent $event
     */
    public function onPreSetData(FormEvent $event)
    {
        parent::onPreSetData($event);
        if (!is_null($event->getData()->getId())) {
            // We don't want to show these fields if it's a new registration.
            $event->getForm()
                // These can be changed after registration
                ->add('registerDate', DateType::class, [
                    'label'         => 'Datum van registratie',
                    'format'        => 'dd-MM-yyyy',
                    'disabled' => true,
                ])
                // In case of edit action don fill field with default data
                ->add('admissionDate', DateType::class, [
                    'label'         => 'Datum van binnenkomst',
                    'format'        => 'dd-MM-yyyy',
                ])
                ->add('dayOfBirth', DateType::class, [
                    'label'         => 'Geboortedatum',
                    'format'        => 'dd-MM-yyyy',
                ])
            ;
        }

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\AnimalBundle\Entity\AnimalType\Dog',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_dog';
    }

    /**
     * Used in the form field to generate the right amount of years
     * @return array
     */
    private function buildYears()
    {
        $years = [];
        for ($i= 1900;$i <= date('Y'); $i++) {
            $years[] .= $i;
        }

        return $years;
    }

}
