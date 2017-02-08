<?php

namespace Asiel\AnimalBundle\Form\StatusType;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbandonedType extends StatusType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('reason', CKEditorType::class, [
                'label'     => 'Reden van afstand doen'
            ])
            ->add('abandonedBy', HiddenType::class, [
                'mapped'     => false,
            ])
            ->add('search', TextType::class, [
                'label'         => 'Afgestaan door',
                'mapped'        => false,
                'attr'          => [
                    'placeholder'  => 'Voer een achternaam in',
                ],
                'label_attr'    => [
                    'id'    => 'search',
                ]
            ])
            ->add('needsChipping', CheckboxType::class, [
                'label'     => 'Moet door ons gechipt worden',
                'required'  => false,
            ])
            ->add('needsVaccines', CheckboxType::class, [
                'label'     => 'Moet door ons gevaccineerd worden',
                'required'  => false,
            ])
            ->add('needsSterilization', CheckboxType::class, [
                'label'     => 'Moet door ons gecastreerd / gesteraliseerd worden',
                'required'  => false,
            ])
            ->add('needsPassport', CheckboxType::class, [
                'label'     => 'Moet nog een paspoort krijgen',
                'required'  => false,
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\AnimalBundle\Entity\StatusType\Abandoned'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_statustype_abandoned';
    }


}
