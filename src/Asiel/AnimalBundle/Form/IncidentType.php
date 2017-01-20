<?php

namespace Asiel\AnimalBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IncidentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'label'     => 'Datum',
                'format'    => 'dd-MM-yyyy',
                'data'      => new \DateTime(),
            ])
            ->add('title', TextType::class, [
                'label'     => 'Korte omschrijving',
                'attr'      => [
                    'placeholder'   => 'Voer een korte omschrijving in'
                ],
                'required'  => true,
            ])
            ->add('description', CKEditorType::class, [
                'label' => 'Omschrijf wat er is gebeurd',
                'required'  => true,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\AnimalBundle\Entity\Incident',
            'required'   => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_incident';
    }


}
