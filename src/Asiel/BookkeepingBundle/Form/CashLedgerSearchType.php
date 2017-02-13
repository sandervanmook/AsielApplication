<?php

namespace Asiel\BookkeepingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CashLedgerSearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datestart', DateType::class, [
                'label' => false,
            ])
            ->add('dateend', DateType::class, [
                'label' => false,
                'data' => new \DateTime('now'),
            ])
            ->add('showall', CheckboxType::class, [
                'label' => 'Laat alles zien',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Zoeken',
                'attr' => [
                    'class' => 'ui button positive'
                ],
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'mapped' => false,
            'required' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bookkeepingbundle_search_cashledger';
    }


}
