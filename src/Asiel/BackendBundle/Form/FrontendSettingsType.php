<?php

namespace Asiel\BackendBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FrontendSettingsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Asielnaam',
                'required' => true,
            ])
            ->add('address', TextType::class, [
                'label' => 'Adres',
                'required' => true,
            ])
            ->add('housenumber', TextType::class, [
                'label' => 'Huisnummer',
                'required' => true,
            ])
            ->add('municipality', TextType::class, [
                'label' => 'Gemeente',
                'required' => true,
            ])
            ->add('zipcode', TextType::class, [
                'label' => 'Postcode',
                'required' => true,
            ])
            ->add('phone', TextType::class, [
                'label' => 'Telefoonnummer',
                'required' => true,
            ])
            ->add('email', TextType::class, [
                'label' => 'Emailadres',
                'required' => true,
            ])
            ->add('cocNumber', TextType::class, [
                'label' => 'Kamer van koophandel nummer',
                'required' => true,
            ])
            ->add('url', TextType::class, [
                'label' => 'URL van de website (zonder http://)',
                'required' => true,
            ])
            ->add('facebook', TextType::class, [
                'label' => 'Facebookadres',
                'required' => true,
            ])
            ->add('logoFilename', TextType::class, [
                'label' => 'Naam van het logobestand',
                'required' => true,
            ])
            ->add('iban', TextType::class, [
                'label' => 'Rekeningnummer (iban)',
                'required' => true,
            ])
            ->add('bic', TextType::class, [
                'label' => 'BIC code',
                'required' => true,
            ])
            ->add('aboutUs', CKEditorType::class, [
                'label' => 'Informatie voor op de over ons pagina',
                'required' => true,
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\BackendBundle\Entity\FrontendSettings'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asiel_backendbundle_frontendsettings';
    }


}
