<?php

namespace Asiel\AnimalBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'         => 'Naam van het dier',
                'required'      => true,
                'attr'          => [
                    'placeholder'   => 'Vul de naam van het dier in'
                ]
            ])
            ->add('dayLocation', EntityType::class, [
                'label'         => 'Locatie overdag',
                'class'         => 'Asiel\LocationBundle\Entity\Location',
                'choice_label'  => 'Name',
            ])
            ->add('nightLocation', EntityType::class, [
                'label'         => "Locatie 's nachts",
                'class'         => 'Asiel\LocationBundle\Entity\Location',
                'choice_label'  => 'Name',
            ])
            ->add('registerDate', DateType::class, [
                'label'         => 'Datum van registratie',
                'format'        => 'dd-MM-yyyy',
                'data'          => new \DateTime(),
                'years'         => $this->buildYears(),
            ])
            ->add('admissionDate', DateType::class, [
                'label'         => 'Datum van binnenkomst',
                'format'        => 'dd-MM-yyyy',
                'data'          => new \DateTime(),
                'years'         => $this->buildYears(),
            ])
            ->add('chipnumber', TextType::class, [
                'label'         => 'Chip nummer van dier',
                'required'      => false,
                'attr'          => [
                    'placeholder'   => 'Vul het 15 cijferige chipnummer van het dier in',
                    'maxlength'     => "15",
                ],
            ])
            ->add('notChipped', CheckboxType::class, [
                'label'         => 'Niet gechipt bij binnenkomst ?',
                'required'      => false,
            ])
            ->add('passportNumber', TextType::class, [
                'label'         => 'Passpoort nummer',
                'attr'          => [
                    'placeholder'   => 'Voer het paspoortnummer in'
                ],
                'required'      => false,
            ])
            ->add('dayOfBirth', DateType::class, [
                'label'         => 'Geboortedatum',
                'format'        => 'dd-MM-yyyy',
                'data'          => new \DateTime(),
                'years'         => $this->buildYears(),
            ])
            ->add('gender', ChoiceType::class, [
                'label'         => 'Geslacht',
                'choices' => [
                    'Man'   => 'Male',
                    'Vrouw' => 'Female',
                    'Onbekend' => 'Unknown'
                ],
                'expanded'      => true,
                'multiple'      => false,
                'required'      => true,
            ])
            ->add('colour', TextType::class, [
                'label'     => 'Kleur van het dier',
                'required'      => false,
                'attr'          => [
                    'placeholder'   => 'Wat is de kleur van het dier'
                ]
            ])
            ->add('characteristics', CKEditorType::class, [
                'label'         => 'Specifieke eigenschappen van het dier',
                'required'      => false,
                'attr'          => [
                    'placeholder'   => 'Vul eigenschappen van dit dier in'
                ]
            ])
            ->add('medicalProblems', CKEditorType::class, [
                'label'         => 'Medische problemen',
                'required'      => false,
            ])
            ->add('compatibleChildrenBelow10y', CheckboxType::class, [
                'label'         => 'Kan met kinderen onder de 10 ?',
                'required'      => false,
            ])
            ->add('compatibleChildrenAbove10y', CheckboxType::class, [
                'label'         => 'Kan met kinderen boven de 10 ?',
                'required'      => false,
            ])
            ->add('description', CKEditorType::class, [
                'label'         => 'Omschrijving van het dier',
                'required'      => false,
            ])
            ->add('outsideAnimal', ChoiceType::class, [
                'label'         => 'Is het een buitendier ?',
                'choices'       => [
                    'Ja'    => 'Ja',
                    'Nee'   => 'Nee',
                    'Binnen en buiten' => 'Binnen en buiten'
                ],
                'multiple'      => false,
                'expanded'      => true,
                'required'      => true,
            ])
            ->add('knownAggression', CKEditorType::class, [
                'label'         => 'Is het dier bekend met aggresie',
                'required'      => false,
            ])
            ->add('visiblePublic', CheckboxType::class, [
                'label'         => 'Zichtbaar voor publiek',
                'required'      => false,
                'label_attr'          => [
                    'class'     => 'text-alert'
                ]
            ])
            ->add('escapesAlot', CheckboxType::class, [
                'label'         => 'Ontsnapt vaak',
                'required'      => false,
            ])
            ->add('compatibleOldPeople', CheckboxType::class, [
                'label'         => 'Geschikt voor oudere mensen',
                'required'      => false,
            ])
            ->add('compatibleChildrenBelow7y', CheckboxType::class, [
                'label'         => 'Kan met kinderen onder de 7 ?',
                'required'      => false,
            ])
            ->add('compatibleChildrenAbove7y', CheckboxType::class, [
                'label'         => 'Kan met kinderen boven de 7 ?',
                'required'      => false,
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

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\AnimalBundle\Entity\Animal',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_animal';
    }

    /**
     * Used in the form field to generate the right amount of years
     * @return array
     */
    private function buildYears()
    {
        $years = [];
        for ($i= 1900;$i <= date('Y'); $i++) {
            $years[] .= $i;
        }

        return $years;
    }

}
