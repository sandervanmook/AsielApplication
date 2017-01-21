<?php

namespace Asiel\EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label'     => 'Gebruikersnaam',
                'attr'      => [
                    'placeholder'   => 'De gebruikersnaam van deze gebruiker'
                ],
                'required'  => true,
            ])
            ->add('password', RepeatedType::class, [
                'type'      => PasswordType::class,
                'label'     => 'Wachtwoord',
                'first_options'  => [
                    'label' => 'Wachtwoord',
                    'attr'  => [
                        'placeholder'   => 'Voer een wachtwoord in'
                    ]
                ],
                'second_options' => [
                    'label' => 'Herhaal het wachtwoord',
                    'attr'  => [
                        'placeholder'   => 'Herhaal het wachtwoord'
                    ]
                ],
                'invalid_message' => 'De wachtwoorden moeten overeen komen.',
                'options'   => ['attr' =>
                    ['class' => 'password-field']
                ],
                'mapped'    => true,
                'required'  => true,
            ])
            ->add('email', EmailType::class, [
                'label'     => 'Emailadres',
                'attr'      => [
                    'placeholder'   => 'Het emailadres van de gebruiker'
                ],
                'required'  => true,
            ])
            ->add('isActive', CheckboxType::class, [
                'label'     => 'Is het account actief ?',
                'required'  => false,

            ])
            ->add('firstname', TextType::class, [
                'label'     => 'Voornaam',
                'attr'      => [
                    'placeholder'   => 'Voer de voornaam in'
                ],
                'required'  => true,
            ])
            ->add('lastname', TextType::class, [
                'label'     => 'Achternaam',
                'attr'      => [
                    'placeholder'   => 'Voer de achternaam in'
                ],
                'required'  => true,
            ])
            ->add('citizenServiceNumber', TextType::class, [
                'label'     => 'Burger service nummer / Rijksregisternummer',
                'attr'      => [
                    'placeholder'   => 'Voer het nummer in'
                ],
                'required'  => true,
            ])
            ->add('dayOfBirth', DateType::class, [
                'label'         => 'Geboortedatum',
                'format'        => 'dd-MM-yyyy',
                'data'          => new \DateTime(),
                'years'         => $this->buildYears(),
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
                    'België'    => 'België',
                    'Nederland' => 'Nederland',
                ],
                'required'  => true,
            ])
            ->add('phone', TextType::class, [
                'label'     => 'Telefoonnummer',
                'attr'      => [
                    'placeholder'   => 'Het thuisnummer van de medewerker'
                ],
                'required'  => false,
            ])
            ->add('mobilePhone', TextType::class, [
                'label'     => 'Mobiel nummer',
                'attr'      => [
                    'placeholder'   => 'Het mobiele nummer van de medewerker'
                ],
                'required'  => false,
            ])
            ->add('startContract', DateType::class, [
                'label'     => 'Datum in dienst'
            ])
            ->add('endContract', DateType::class, [
                'label'     => 'Datum uit dienst'
            ])
            ->add('reasonEndContract', TextareaType::class, [
                'label'     => 'Reden uit dienst',
                'required'  => false,
            ])
            ->add('emergencyContact', TextType::class, [
                'label'     => 'Contactpersoon bij noodgeval',
                'attr'      => [
                    'placeholder'   => 'De naam van de persoon'
                ],
                'required'  => false,
            ])
            ->add('emergencyContactPhone', TextType::class, [
                'label'     => 'Telefoonnummer bij noodgeval',
                'attr'      => [
                    'placeholder'   => 'Het telefoonnummer van de persoon'
                ],
                'required'  => false,
            ])
            ->add('roles', ChoiceType::class, [
                'label'     => 'Rollen',
                'choices'   => [
                    'Beheerder *'               => 'ROLE_ADMIN',
                    'Wandelaar honden'          => 'ROLE_WALK_DOG',
                    'Verzorger honden'          => 'ROLE_NURSE_DOG',
                    'Verzorger katten'          => 'ROLE_NURSE_CAT',
                    'Verzorger ziekenboeg'      => 'ROLE_NURSE_ILL',
                    'Verzorger quarantaine'     => 'ROLE_NURSE_QUAR',
                    'Hondenvanger'              => 'ROLE_CATCH_DOG',
                    'Algemeen opzichter'        => 'ROLE_SUPERVISOR'
                ],
                'multiple'  => true,
                'required'  => false,
                'expanded'    => true,
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
                // Don't allow these fields to be changed
                ->add('username', TextType::class, [
                    'label'     => 'Gebruikersnaam',
                    'disabled'  => true,
                ])
                // Disable the password fields on user edit
                ->add('password', RepeatedType::class, [
                    'type'      => PasswordType::class,
                    'label'     => 'Wachtwoord',
                    'first_options'  => [
                        'label' => 'Wachtwoord',
                        'attr'  => [
                            'placeholder'   => 'Voer een wachtwoord in'
                        ]
                    ],
                    'disabled'  => true,
                    'second_options' => [
                        'label' => 'Herhaal het wachtwoord',
                        'attr'  => [
                            'placeholder'   => 'Herhaal het wachtwoord'
                        ]
                    ],
                    'invalid_message' => 'De wachtwoorden moeten overeen komen.',
                    'options'   => ['attr' =>
                        ['class' => 'password-field']
                    ],
                    'mapped'    => true,
                    'required'  => false,
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
            'data_class' => 'Asiel\EmployeeBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_user';
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
