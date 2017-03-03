<?php

namespace Asiel\CalendarBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarItemType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateCreated', DateType::class, [
                'label'         => 'Datum van aanmaken',
                'format'        => 'dd-MM-yyyy',
                'data'          => new \DateTime(),
            ])
            ->add('dateDue', DateTimeType::class, [
                'label'         => 'Wanneer begint de afspraak',
                'format'        => 'dd-MM-yyyy',
                'data'          => new \DateTime(),
            ])
            ->add('dateDueEnd', DateTimeType::class, [
                'label'         => 'Wanneer eindigt de afspraak',
                'format'        => 'dd-MM-yyyy',
                'data'          => new \DateTime(),
            ])
            ->add('title', TextType::class, [
                'label'         => 'Titel',
                'required' => true,
            ])
            ->add('description', CKEditorType::class, [
                'label'         => 'Omschrijf de afspraak',
                'required' => false,
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
        if (!is_null($event->getData()->getId())) {
            $event->getForm()
                // These can't be changed after registration
                ->add('dateCreated', DateType::class, [
                    'label'         => 'Datum van aanmaken',
                    'format'        => 'dd-MM-yyyy',
                    'disabled' => true,
                ])
                // In case of edit action don't fill field with default data
                ->add('dateDue', DateTimeType::class, [
                    'label'         => 'Wanneer begint de afspraak',
                    'format'        => 'dd-MM-yyyy',
                ])
                ->add('dateDueEnd', DateTimeType::class, [
                    'label'         => 'Wanneer eindigt de afspraak',
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
            'data_class' => 'Asiel\CalendarBundle\Entity\CalendarItem'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_calendaritem';
    }


}
