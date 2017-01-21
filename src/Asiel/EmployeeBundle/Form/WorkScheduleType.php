<?php

namespace Asiel\EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkScheduleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('monStart', TimeType::class, [
                'label' => 'Maandag start',
            ])
            ->add('monEnd', TimeType::class, [
                'label' => 'einde',
            ])
            ->add('tueStart', TimeType::class, [
                'label' => 'Dinsdag start',
            ])
            ->add('tueEnd', TimeType::class, [
                'label' => 'einde',
            ])
            ->add('wedStart', TimeType::class, [
                'label' => 'Woensdag start',
            ])
            ->add('wedEnd', TimeType::class, [
                'label' => 'einde',
            ])
            ->add('thuStart', TimeType::class, [
                'label' => 'Donderdag start',
            ])
            ->add('thuEnd', TimeType::class, [
                'label' => 'einde',
            ])
            ->add('friStart', TimeType::class, [
                'label' => 'Vrijdag start',
            ])
            ->add('friEnd', TimeType::class, [
                'label' => 'einde',
            ])
            ->add('satStart', TimeType::class, [
                'label' => 'Zaterdag start',
            ])
            ->add('satEnd', TimeType::class, [
                'label' => 'einde',
            ])
            ->add('sunStart', TimeType::class, [
                'label' => 'Zaterdag start',
            ])
            ->add('sunEnd', TimeType::class, [
                'label' => 'einde',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\EmployeeBundle\Entity\WorkSchedule'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_user_workschedule';
    }


}
