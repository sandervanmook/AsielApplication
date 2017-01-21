<?php

namespace Asiel\EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPasswordType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        ;
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Asiel\EmployeeBundle\Entity\User'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_edit_password';
    }


}
