<?php

namespace Asiel\AnimalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MunicipalityType extends AbstractType
{
    // Use this as data field in the form if you want to select all by default
    const CHOICES = [
        '' => '',
        'Alken' => 'Alken',
        'As' => 'As',
        'Beringen' => 'Beringen',
        'Bilzen' => 'Bilzen',
        'Bocholt' => 'Bocholt',
        'Borgloon' => 'Borgloon',
        'Bree' => 'Bree',
        'Diepenbeek' => 'Diepenbeek',
        'Dilsen-Stokkem' => 'Dilsen-Stokkem',
        'Genk' => 'Genk',
        'Gingelom' => 'Gingelom',
        'Halen' => 'Halen',
        'Ham' => 'Ham',
        'Hamont-Achel' => 'Hamont-Achel',
        'Hasselt' => 'Hasselt',
        'Hechtel-Eksel' => 'Hechtel-Eksel',
        'Heers' => 'Heers',
        'Herk-de-Stad' => 'Herk-de-Stad',
        'Herstappe' => 'Herstappe',
        'Heusden-Zolder' => 'Heusden-Zolder',
        'Hoeselt' => 'Hoeselt',
        'Houthalen-Helchteren' => 'Houthalen-Helchteren',
        'Kinrooi' => 'Kinrooi',
        'Kortessem' => 'Kortessem',
        'Lanaken' => 'Lanaken',
        'Leopoldsburg' => 'Leopoldsburg',
        'Lommel' => 'Lommel',
        'Lummen' => 'Lummen',
        'Maaseik' => 'Maaseik',
        'Maasmechelen' => 'Maasmechelen',
        'Meeuwen-Gruitrode' => 'Meeuwen-Gruitrode',
        'Neerpelt' => 'Neerpelt',
        'Nieuwerkerken' => 'Nieuwerkerken',
        'Opglabbeek' => 'Opglabbeek',
        'Overpelt' => 'Overpelt',
        'Peer' => 'Peer',
        'Riemst' => 'Riemst',
        'Sint-Truiden' => 'Sint-Truiden',
        'Tessenderlo' => 'Tessenderlo',
        'Tongeren' => 'Tongeren',
        'Voeren' => 'Voeren',
        'Wellen' => 'Wellen',
        'Zonhoven' => 'Zonhoven',
        'Zutendaal' => 'Zutendaal',
    ];


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => self::CHOICES,
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
