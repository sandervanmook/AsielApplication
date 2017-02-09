<?php

namespace Asiel\BookkeepingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'label' => 'Datum',
                'data' => new \DateTime('now'),
            ])
            ->add('dueDate', DateType::class, [
                'label' => 'Betalen voor (indien van toepassing)',
                'data' => new \DateTime('now'),
            ])
            ->add('paymentType', ChoiceType::class, [
                'label' => 'Manier van betalen',
                'choices' => [
                    'Contant' => 'Cash',
                    'Bank' => 'Bank',
                    'Factuur' => 'Invoice',
                ],
            ])
            ->add('paidAmount', MoneyType::class, [
                'label' => 'Bedrag'
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type betaling',
                'choices' => [
                    'Aanbetaling' => 'Deposit',
                    'Volledig'  => 'inFull',
                ],
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
            'data_class' => 'Asiel\BookkeepingBundle\Entity\Transaction'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asiel_bookkeepingbundle_transaction';
    }


}
