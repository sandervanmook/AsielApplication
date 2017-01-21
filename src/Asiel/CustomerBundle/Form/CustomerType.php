<?php

namespace Asiel\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'     => 'Voornaam',
                'attr'      => [
                    'placeholder'   => 'De voornaam van de klant'
                ],
                'required'  => false,
            ])
            ->add('lastname', TextType::class, [
                'label'     => 'Achternaam',
                'attr'      => [
                    'placeholder'   => 'De achternaam van de klant'
                ],
                'required'  => true,
            ])
            ->add('dayOfBirth', DateType::class, [
                'label'         => 'Geboortedatum',
                'format'        => 'dd-MM-yyyy',
                'data'          => new \DateTime(),
                'years'         => $this->buildYears(),
            ])
            ->add('citizenServiceNumber', TextType::class, [
                'label'     => 'Burger service nummer / Rijksregisternummer',
                'attr'      => [
                    'placeholder'   => 'Voer het nummer in'
                ],
                'required'  => true,
            ])
            ->add('email', EmailType::class, [
                'label'     => 'Email adres',
                'attr'      => [
                    'placeholder'   => 'Het emailadres van de klant'
                ],
                'required'  => true,
            ])
            ->add('phone', TextType::class, [
                'label'     => 'Telefoonnummer',
                'attr'      => [
                    'placeholder'   => 'Het telefoonnummer van de klant'
                ],
                'required'  => false,
            ])
            ->add('address', TextType::class, [
                'label'     => 'Adres',
                'attr'      => [
                    'placeholder'   => 'Vul een straatnaam in'
                ],
                'required'  => true,
            ])
            ->add('houseNumber', TextType::class, [
                'label'     => 'Huisnummer',
                'attr'      => [
                    'placeholder'   => 'Vul een huisnummer in'
                ],
                'required'  => true,
            ])
            ->add('zipcode', TextType::class, [
                'label'     => 'Postcode',
                'attr'      => [
                    'placeholder'   => 'Vul een postcode in'
                ],
                'required'  => true,
            ])
            ->add('city', TextType::class, [
                'label'     => 'Stad',
                'attr'      => [
                    'placeholder'   => 'Vul een stad in'
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
            ->add('blacklisted', CheckboxType::class, [
                'label'     => 'Staat deze persoon op de zwarte lijst',
                'required'  => false,
            ])
            ->add('blacklistedReason', TextareaType::class, [
                'label'     => 'Waarom staat de persoon op de zwarte lijst',
                'label_attr' => [
                    'id'    => 'blacklistreasonlabel',
                ],
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
            'data_class' => 'Asiel\CustomerBundle\Entity\Customer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_customer';
    }

    private function buildYears()
    {
        $years = [];
        for ($i= 1900;$i <= date('Y'); $i++) {
            $years[] .= $i;
        }

        return $years;
    }

}
