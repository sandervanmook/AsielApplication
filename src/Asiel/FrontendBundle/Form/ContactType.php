<?php

namespace Asiel\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reason', ChoiceType::class, [
                'label'     => 'Reden van uw bericht',
                'choices'   => [
                    'Vraag over het asiel'      => 'Vraag over het asiel',
                    'Hoe kan ik helpen'         => 'Hoe kan ik helpen' ,
                    'Vraag over adoptie'        => 'Vraag over adoptie',
                    'Vrijwilligerswerk'         => 'Vrijwilligerswerk',
                    'Lid worden'                => 'Lid worden',
                    'Ik ben een dier kwijt'     => 'Ik ben een dier kwijt',
                    'Ik wil een dier plaatsen'  => 'Ik wil een dier plaatsen',
                    'Anders'                    => 'Anders',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Uw naam',
                'attr'  => [
                    'placeholder'   => 'Voer uw naam in'
                ],
                'required'  => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Uw emailadres',
                'attr'  => [
                    'placeholder'   => 'Voer uw emailadres in'
                ],
                'required'  => true,
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Uw bericht',
                'required'  => true,
            ])
        ;
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_public_contact';
    }


}
