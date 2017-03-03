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

class DogType extends AnimalType
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
                'multiple' => false,
                'choices' => [
                    'Afghaanse Windhond' => 'Afghaanse Windhond',
                    'Airedale Terriër' => 'Airedale Terriër',
                    'Akita' => 'Akita',
                    'American Staffordshire Terriër' => 'American Staffordshire Terriër',
                    'Amerikaanse Cocker Spaniël' => 'Amerikaanse Cocker Spaniël',
                    'Australian Shepherd' => 'Australian Shepherd',
                    'Basset fauve de Bretagne' => 'Basset fauve de Bretagne',
                    'Basset Hound' => 'Basset Hound',
                    'Beagle' => 'Beagle',
                    'Bearded Collie' => 'Bearded Collie',
                    'Belgische Herdershond, Groenendaeler' => 'Belgische Herdershond, Groenendaeler',
                    'Belgische Herdershond, Mechelse' => 'Belgische Herdershond, Mechelse',
                    'Belgische Herdershond, Tervuerense' => 'Belgische Herdershond, Tervuerense',
                    'Berner Sennenhond' => 'Berner Sennenhond',
                    'Bloedhond' => 'Bloedhond',
                    'Boerboel' => 'Boerboel',
                    'Bordeaux Dog' => 'Bordeaux Dog',
                    'Border Collie' => 'Border Collie',
                    'Border Terriër' => 'Border Terriër',
                    'Boston Terriër' => 'Boston Terriër',
                    'Bouvier des Flandres' => 'Bouvier des Flandres',
                    'Boxer' => 'Boxer',
                    'Briard' => 'Briard',
                    'Bull Terriër' => 'Bull Terriër',
                    'Bull Terriër Miniatuur' => 'Bull Terriër Miniatuur',
                    'Bullmastiff' => 'Bullmastiff',
                    'Cairn Terriër' => 'Cairn Terriër',
                    'Cane Corso' => 'Cane Corso',
                    'Cavalier King Charles Spaniël' => 'Cavalier King Charles Spaniël',
                    'Chihuahua' => 'Chihuahua',
                    'Chinese Naakthond' => 'Chinese Naakthond',
                    'Chow Chow' => 'Chow Chow',
                    'Clumber Spaniël' => 'Clumber Spaniël',
                    'Dalmatische Hond' => 'Dalmatische Hond',
                    'Dashond, korthaar (Teckel)' => 'Dashond, korthaar (Teckel)',
                    'Dashond, langhaar (Teckel)' => 'Dashond, langhaar (Teckel)',
                    'Dashond, ruwhaar (Teckel)' => 'Dashond, ruwhaar (Teckel)',
                    'Dobermann' => 'Dobermann',
                    'Drentsche Patrijshond' => 'Drentsche Patrijshond',
                    'Duitse Dog' => 'Duitse Dog',
                    'Duitse Herdershond' => 'Duitse Herdershond',
                    'Duitse Staande Hond Draadhaar' => 'Duitse Staande Hond Draadhaar',
                    'Dwergkeeshond' => 'Dwergkeeshond',
                    'Dwergschnauzer' => 'Dwergschnauzer',
                    'Engelse Bulldog' => 'Engelse Bulldog',
                    'Engelse Cocker Spaniël' => 'Engelse Cocker Spaniël',
                    'Engelse Springer Spaniël' => 'Engelse Springer Spaniël',
                    'Flatcoated Retriever' => 'Flatcoated Retriever',
                    'Foxterriër, draadhaar' => 'Foxterriër, draadhaar',
                    'Foxterriër, gladhaar' => 'Foxterriër, gladhaar',
                    'Franse Bulldog' => 'Franse Bulldog',
                    'Golden Retriever' => 'Golden Retriever',
                    'Havanezer' => 'Havanezer',
                    'Heidewachtel' => 'Heidewachtel',
                    'Hollandse Herdershond' => 'Hollandse Herdershond',
                    'Hollandse Smoushond' => 'Hollandse Smoushond',
                    'Hovawart' => 'Hovawart',
                    'Ierse Setter' => 'Ierse Setter',
                    'Ierse Water Spaniël' => 'Ierse Water Spaniël',
                    'Ierse Wolfshond' => 'Ierse Wolfshond',
                    'Irish Softcoated Wheaten Terriër' => 'Irish Softcoated Wheaten Terriër',
                    'Jack Russell Terriër' => 'Jack Russell Terriër',
                    'Japanse Spaniël' => 'Japanse Spaniël',
                    'Labradoodle' => 'Labradoodle',
                    'Labrador Retriever' => 'Labrador Retriever',
                    'Lagotto Romagnolo' => 'Lagotto Romagnolo',
                    'Leonberger' => 'Leonberger',
                    'Lhasa Apso' => 'Lhasa Apso',
                    'Maltezer' => 'Maltezer',
                    'Markiesje' => 'Markiesje',
                    'Mastiff' => 'Mastiff',
                    'Mastino Napoletano' => 'Mastino Napoletano',
                    'Middenslag Schnauzer' => 'Middenslag Schnauzer',
                    'Mopshond' => 'Mopshond',
                    'Nederlandse Kooikerhondje' => 'Nederlandse Kooikerhondje',
                    'Nederlandse Schapendoes' => 'Nederlandse Schapendoes',
                    'Newfoundlander' => 'Newfoundlander',
                    'Norwich Terriër' => 'Norwich Terriër',
                    'Nova Scotia Duck Tolling Retriever' => 'Nova Scotia Duck Tolling Retriever',
                    'Parson Russell Terriër' => 'Parson Russell Terriër',
                    'Pekingees' => 'Pekingees',
                    'Poedel, middenslag' => 'Poedel, middenslag',
                    'Rhodesian Ridgeback' => 'Rhodesian Ridgeback',
                    'Riesenschnauzer' => 'Riesenschnauzer',
                    'Rottweiler' => 'Rottweiler',
                    'Saarlooswolfhond' => 'Saarlooswolfhond',
                    'Schotse Herdershond, langhaar' => 'Schotse Herdershond, langhaar',
                    'Schotse Terriër' => 'Schotse Terriër',
                    'Shar-Pei' => 'Shar-Pei',
                    'Shetland Sheepdog' => 'Shetland Sheepdog',
                    'Shiba' => 'Shiba',
                    'Shih Tzu' => 'Shih Tzu',
                    'Siberian Husky' => 'Siberian Husky',
                    'Sint Bernard' => 'Sint Bernard',
                    'Stabyhoun (Friese Stabij)' => 'Stabyhoun (Friese Stabij)',
                    'Staffordshire Bull Terriër' => 'Staffordshire Bull Terriër',
                    'Tamaskan' => 'Tamaskan',
                    'Tibetaanse Terriër' => 'Tibetaanse Terriër',
                    'Vizsla, korthaar' => 'Vizsla, korthaar',
                    'Weimaraner' => 'Weimaraner',
                    'Welsh Corgi Cardigan' => 'Welsh Corgi Cardigan',
                    'Welsh Corgi Pembroke' => 'Welsh Corgi Pembroke',
                    'Welsh Springer Spaniël' => 'Welsh Springer Spaniël',
                    'Welsh Terriër' => 'Welsh Terriër',
                    'West Highland White Terriër' => 'West Highland White Terriër',
                    'Wetterhoun' => 'Wetterhoun',
                    'Whippet' => 'Whippet',
                    'Yorkshire Terriër' => 'Yorkshire Terriër',
                    'Zwitserse Witte Herdershond' => 'Zwitserse Witte Herdershond',
                ],
            ])
            ->add('knownCommands', CKEditorType::class, [
                'label' => 'Welke commando\'s snapt de hond',
                'required' => false,
            ])
            ->add('needsExercise', CheckboxType::class, [
                'label' => 'Heeft de hond beweging nodig ?',
                'required' => false,
            ])
            ->add('furType', ChoiceType::class, [
                'label' => 'Type vacht',
                'required' => true,
                'multiple' => false,
                'choices' => [
                    'Kort of gladhaar' => 'Kort of gladhaar',
                    'Kort stokhaar' => 'Kort stokhaar',
                    'Stokhaar met ondervacht' => 'Stokhaar met ondervacht',
                    'Langharige stokhaar' => 'Langharige stokhaar',
                    'Krulhaar' => 'Krulhaar',
                    'Kort tot middellang zijdehaar' => 'Kort tot middellang zijdehaar',
                    'Zacht dekhaar en ondervacht' => 'Zacht dekhaar en ondervacht',
                    'Ruwharige vacht (warhaar, ruighaar, stekelhaar of draadhaar).' => 'Ruwharige vacht (warhaar, ruighaar, stekelhaar of draadhaar).',
                    'Langhaar met ondervacht' => 'Langhaar met ondervacht',
                    'Langhaar met zacht dekhaar en een (gelaagde) ondervacht' => 'Langhaar met zacht dekhaar en een (gelaagde) ondervacht',
                    'Langharen met een enkele vacht' => 'Langharen met een enkele vacht',
                    'Viltvacht' => 'Viltvacht',
                    'Naakthond' => 'Naakthond',
                ],
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
                'label' => 'Kan samen met katten ?',
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
                'multiple' => false,
                'choices' => [
                    'Albino' => 'Albino',
                    'Beige' => 'Beige',
                    'Blauw' => 'Blauw',
                    'Bont' => 'Bont',
                    'Bruin' => 'Bruin',
                    'Chocolade' => 'Chocolade',
                    'Geel' => 'Geel',
                    'Getijgerd / Gestroomd' => 'Getijgerd / Gestroomd',
                    'Gevlekt (zwart wit)' => 'Gevlekt (zwart wit)',
                    'Lichtgeel' => 'Lichtgeel',
                    'Rood' => 'Rood',
                    'Ros' => 'Ros',
                    'Tricolor' => 'Tricolor',
                    'Wit' => 'Wit',
                    'Zwart' => 'Zwart',
                ],
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
                // In case of edit action don fill field with default data
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
        $resolver
            ->setDefaults([
                'data_class' => 'Asiel\AnimalBundle\Entity\AnimalType\Dog',
            ])
            ->setRequired('animaltype');;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asielbundle_dog';
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
