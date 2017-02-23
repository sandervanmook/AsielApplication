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
        '[België]' => [
            '[Antwerpen]' => [
                'Aartselaar' => 'Aartselaar',
                'Antwerpen' => 'Antwerpen',
                'Arendonk' => 'Arendonk',
                'Baarle-Hertog' => 'Baarle-Hertog',
                'Balen' => 'Balen',
                'Beerse' => 'Beerse',
                'Berlaar' => 'Berlaar',
                'Boechout' => 'Boechout',
                'Bonheiden' => 'Bonheiden',
                'Boom' => 'Boom',
                'Bornem' => 'Bornem',
                'Borsbeek' => 'Borsbeek',
                'Brasschaat' => 'Brasschaat',
                'Brecht' => 'Brecht',
                'Dessel' => 'Dessel',
                'Duffel' => 'Duffel',
                'Edegem' => 'Edegem',
                'Essen' => 'Essen',
                'Geel' => 'Geel',
                'Grobbendonk' => 'Grobbendonk',
                'Heist-op-den-Berg' => 'Heist-op-den-Berg',
                'Hemiksem' => 'Hemiksem',
                'Herentals' => 'Herentals',
                'Herenthout' => 'Herenthout',
                'Herselt' => 'Herselt',
                'Hoogstraten' => 'Hoogstraten',
                'Hove' => 'Hove',
                'Hulshout' => 'Hulshout',
                'Kalmthout' => 'Kalmthout',
                'Kapellen' => 'Kapellen',
                'Kasterlee' => 'Kasterlee',
                'Kontich' => 'Kontich',
                'Laakdal' => 'Laakdal',
                'Lier' => 'Lier',
                'Lille' => 'Lille',
                'Lint' => 'Lint',
                'Malle' => 'Malle',
                'Mechelen' => 'Mechelen',
                'Meerhout' => 'Meerhout',
                'Merksplas' => 'Merksplas',
                'Mol' => 'Mol',
                'Mortsel' => 'Mortsel',
                'Niel' => 'Niel',
                'Nijlen' => 'Nijlen',
                'Olen' => 'Olen',
                'Oud-Turnhout' => 'Oud-Turnhout',
                'Putte' => 'Putte',
                'Puurs' => 'Puurs',
                'Ranst' => 'Ranst',
                'Ravels' => 'Ravels',
                'Retie' => 'Retie',
                'Rijkevorsel' => 'Rijkevorsel',
                'Rumst' => 'Rumst',
                'Schelle' => 'Schelle',
                'Schilde' => 'Schilde',
                'Schoten' => 'Schoten',
                'Sint-Amands' => 'Sint-Amands',
                'Sint-Katelijne-Waver' => 'Sint-Katelijne-Waver',
                'Stabroek' => 'Stabroek',
                'Turnhout' => 'Turnhout',
                'Vorselaar' => 'Vorselaar',
                'Vosselaar' => 'Vosselaar',
                'Westerlo' => 'Westerlo',
                'Wijnegem' => 'Wijnegem',
                'Willebroek' => 'Willebroek',
                'Wommelgem' => 'Wommelgem',
                'Wuustwezel' => 'Wuustwezel',
                'Zandhoven' => 'Zandhoven',
                'Zoersel' => 'Zoersel',
                'Zwijndrecht' => 'Zwijndrecht',
            ],
            '[Limburg]' => [
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
            ]
        ],
        '[Nederland]' => [
            '[Limburg]' => [
                'Beek' => 'Beek',
                'Beesel' => 'Beesel',
                'Bergen' => 'Bergen',
                'Brunssum' => 'Brunssum',
                'Echt-Susteren' => 'Echt-Susteren',
                'Eijsden-Margraten' => 'Eijsden-Margraten',
                'Gennep' => 'Gennep',
                'Gulpen-Wittem' => 'Gulpen-Wittem',
                'Heerlen' => 'Heerlen',
                'Horst aan de Maas' => 'Horst aan de Maas',
                'Kerkrade' => 'Kerkrade',
                'Landgraaf' => 'Landgraaf',
                'Leudal' => 'Leudal',
                'Maasgouw' => 'Maasgouw',
                'Maastricht' => 'Maastricht',
                'Meerssen' => 'Meerssen',
                'Mook en Middelaar' => 'Mook en Middelaar',
                'Nederweert' => 'Nederweert',
                'Nuth' => 'Nuth',
                'Onderbanken' => 'Onderbanken',
                'Peel en Maas' => 'Peel en Maas',
                'Roerdalen' => 'Roerdalen',
                'Roermond' => 'Roermond',
                'Schinnen' => 'Schinnen',
                'Simpelveld' => 'Simpelveld',
                'Sittard-Geleen' => 'Sittard-Geleen',
                'Stein' => 'Stein',
                'Vaals' => 'Vaals',
                'Valkenburg aan de Geul' => 'Valkenburg aan de Geul',
                'Venlo' => 'Venlo',
                'Venray' => 'Venray',
                'Voerendaal' => 'Voerendaal',
                'Weert' => 'Weert',
                ],
        ]
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

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'municipality';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
