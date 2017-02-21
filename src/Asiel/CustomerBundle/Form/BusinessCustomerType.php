<?php

namespace Asiel\CustomerBundle\Form;

use Asiel\AnimalBundle\Form\MunicipalityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusinessCustomerType extends CustomerType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('companyName', TextType::class, [
                'label' => 'De bedrijfsnaam',
                'attr' => [
                    'placeholder' => 'Vul de naam in'
                ],
                'required' => false,
            ])
            ->add('contactFirstname', TextType::class, [
                'label' => 'Voornaam Contactpersoon',
                'attr' => [
                    'placeholder' => 'Vul de voornaam in'
                ],
                'required' => false,
            ])
            ->add('contactLastname', TextType::class, [
                'label' => 'Achternaam Contactpersoon',
                'attr' => [
                    'placeholder' => 'Vul de achternaam in'
                ],
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email adres',
                'attr' => [
                    'placeholder' => 'Het email adres van het bedrijf'
                ],
                'required' => true,
            ])
            ->add('phone', TextType::class, [
                'label' => 'Telefoonnummer',
                'attr' => [
                    'placeholder' => 'Vul het telefoonnummer in'
                ],
                'required' => false,
            ])
            ->add('address', TextType::class, [
                'label' => 'Adres',
                'attr' => [
                    'placeholder' => 'Vul het adres in'
                ],
                'required' => true,
            ])
            ->add('houseNumber', TextType::class, [
                'label' => 'Huisnummer',
                'attr' => [
                    'placeholder' => 'Vul het huisnummer in'
                ],
                'required' => true,
            ])
            ->add('municipality', MunicipalityType::class, [
                'label'     => 'Gemeente',
            ])
            ->add('zipcode', TextType::class, [
                'label'     => 'Postcode',
                'attr'      => [
                    'placeholder'   => 'Vul een postcode in'
                ],
                'required'  => true,
            ])
            ->add('country', ChoiceType::class, [
                'label'     => 'Land',
                'choices'   => [
                    'België'    => 'Belgium',
                    'Nederland' => 'Netherlands',
                ],
                'required'  => true,
            ])
            ->add('accountNumber', TextType::class, [
                'label'     => 'Bankrekening nummer',
                'attr'      => [
                    'placeholder'   => 'Vul het bankrekeningnummer in'
                ],
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
            'data_class' => 'Asiel\CustomerBundle\Entity\BusinessCustomer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asiel_customerbundle_businesscustomer';
    }


}
