<?php

namespace Asiel\AnimalBundle\Form\StatusType;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeceasedType extends StatusType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('wayDeceased', ChoiceType::class, [
                'label'         => 'Manier van overlijden',
                'choices'       => [
                    'Natuurlijk overleden'  => 'natural_death',
                    'Ingeslapen'            => 'put_down'
                ],
            ])
            ->add('reason', CKEditorType::class, [
                'label'         => 'Reden van overlijden',
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\AnimalBundle\Entity\StatusType\Deceased'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_statustype_deceased';
    }


}
