<?php

namespace Asiel\AnimalBundle\Form\AnimalType;

use Asiel\AnimalBundle\Form\AnimalType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatType extends AnimalType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('race', ChoiceType::class, [
                'label' => 'Ras',
                'required' => true,
                'choices' => [
                    'Abessijn' => 'Abessijn',
                    'American Curl' => 'American Curl',
                    'Balinees' => 'Balinees',
                    'Bengaal' => 'Bengaal',
                    'Blauwe rus' => 'Blauwe rus',
                    'Bombay' => 'Bombay',
                    'Brits korthaar' => 'Brits korthaar',
                    'Brits langhaar' => 'Brits langhaar',
                    'Burmees' => 'Burmees',
                    'Chartreux' => 'Chartreux',
                    'Cornish Rex' => 'Cornish Rex',
                    'Devon Rex' => 'Devon Rex',
                    'Don Sphinx' => 'Don Sphinx',
                    'Egyptische Mau' => 'Egyptische Mau',
                    'Europees Korthaar' => 'Europees Korthaar',
                    'Exotic' => 'Exotic',
                    'German Rex' => 'German Rex',
                    'Havana Brown' => 'Havana Brown',
                    'Heilige Birmaan' => 'Heilige Birmaan',
                    'Japanse Stompstaartkat' => 'Japanse Stompstaartkat',
                    'Korat' => 'Korat',
                    'LaPerm' => 'LaPerm',
                    'Maine Coon' => 'Maine Coon',
                    'Manx' => 'Manx',
                    'Munchkin' => 'Munchkin',
                    'Nebelung' => 'Nebelung',
                    'Noorse boskat' => 'Noorse boskat',
                    'Ocicat' => 'Ocicat',
                    'Oosters korthaar' => 'Oosters korthaar',
                    'Oosters langhaar' => 'Oosters langhaar',
                    'Oregon Rex' => 'Oregon Rex',
                    'Pers' => 'Pers',
                    'Peterbald' => 'Peterbald',
                    'Pixie Bob' => 'Pixie Bob',
                    'Ragdoll' => 'Ragdoll',
                    'Savannah' => 'Savannah',
                    'Schotse Vouwoorkat' => 'Schotse Vouwoorkat',
                    'Selkirk Rex' => 'Selkirk Rex',
                    'Siamees' => 'Siamees',
                    'Singapura' => 'Singapura',
                    'Snowshoe' => 'Snowshoe',
                    'Sokoke' => 'Sokoke',
                    'Somali' => 'Somali',
                    'Sphunx' => 'Sphunx',
                    'Tonkanees' => 'Tonkanees',
                    'Toyger' => 'Toyger',
                    'Turkse Angora' => 'Turkse Angora',
                    'Turkse Van' => 'Turkse Van',
                    'Ural Rex' => 'Ural Rex',
                ],
                'data' => 'Europees Korthaar',
            ])
            ->add('sterilized', CheckboxType::class, [
                'label' => 'Gesteriliseerd / Gecastereerd',
                'required' => false,
            ])
            ->add('compatibleSmallDog', CKEditorType::class, [
                'label' => 'Kan het dier met kleine honden overweg ?',
                'required' => false,
            ])
            ->add('compatibleLargeDog', CKEditorType::class, [
                'label' => 'Kan het dier met grote honden overweg ?',
                'required' => false,
            ])
            ->add('compatibleCat', CKEditorType::class, [
                'label' => 'Kan samen met andere katten ?',
                'required' => false,
            ])
            ->add('compatibleOtherAnimals', CKEditorType::class, [
                'label' => 'Kan het met andere dieren overweg ?',
                'required' => false,
            ])
            ->add('toiletTrained', CheckboxType::class, [
                'label' => 'Zindelijk',
                'required' => false,
            ])
            ->add('colour', ChoiceType::class, [
                'label' => 'Kleur van het dier',
                'required' => true,
                'choices' => [
                    'Albino' => 'Albino',
                    'Apricot' => 'Apricot',
                    'Blauw' => 'Blauw',
                    'Bronze' => 'Bronze',
                    'Caramel' => 'Caramel',
                    'Champagne' => 'Champagne',
                    'Charcoal' => 'Charcoal',
                    'Chocolate' => 'Chocolate',
                    'Cinnamon' => 'Cinnamon',
                    'Crème' => 'Crème',
                    'Fawn' => 'Fawn',
                    'Golden' => 'Golden',
                    'Lilac' => 'Lilac',
                    'Mink' => 'Mink',
                    'Peach' => 'Peach',
                    'Platinum' => 'Platinum',
                    'Rood' => 'Rood',
                    'Ruddy' => 'Ruddy',
                    'Seal' => 'Seal',
                    'Sepia' => 'Sepia',
                    'Schildpad' => 'Schilpad',
                    'Snow' => 'Snow',
                    'Sorrel' => 'Sorrel',
                    'Tan' => 'Tan',
                    'Tawny' => 'Tawny',
                    'Tricolor' => 'Tricolor',
                    'Wildkleur' => 'Wildkleur',
                    'Wit' => 'Wit',
                    'Zilver' => 'Zilver',
                    'Zwart' => 'Zwart',
                ],
                'multiple' => false,
            ])
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
            );
    }

    /**
     * @param FormEvent $event
     */
    public function onPreSetData(FormEvent $event)
    {
        parent::onPreSetData($event);
        if (!is_null($event->getData()->getId())) {
            // We don't want to show these fields if it's a new registration.
            $event->getForm()
                // In case of edit action don't fill field with default data
                ->add('admissionDate', DateType::class, [
                    'label' => 'Datum van binnenkomst',
                    'format' => 'dd-MM-yyyy',
                ])
                ->add('dayOfBirth', DateType::class, [
                    'label' => 'Geboortedatum',
                    'format' => 'dd-MM-yyyy',
                ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\AnimalBundle\Entity\AnimalType\Cat',
        ))
            ->setRequired('animaltype');;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_cat';
    }

    /**
     * Used in the form field to generate the right amount of years
     * @return array
     */
    private function buildYears()
    {
        $years = [];
        for ($i = 1900; $i <= date('Y'); $i++) {
            $years[] .= $i;
        }

        return $years;
    }

}
