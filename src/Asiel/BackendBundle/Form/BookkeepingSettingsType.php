<?php

namespace Asiel\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookkeepingSettingsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('priceAdoptedKitten', MoneyType::class, [
                'label' => 'Prijs adoptie kitten',
                'scale' => 0,
            ])
            ->add('priceAdoptedCat', MoneyType::class, [
                'label' => 'Prijs adoptie kat',
                'scale' => 0,
            ])
            ->add('priceAdoptedPuppy', MoneyType::class, [
                'label' => 'Prijs adoptie puppy',
                'scale' => 0,
            ])
            ->add('priceAdoptedDog', MoneyType::class, [
                'label' => 'Prijs adoptie hond',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogUnaffiliatedYoungerThanOne', MoneyType::class, [
                'label' => 'Prijs afstand hond jonger dan 1 jaar ',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogUnaffiliatedOlderThanOne', MoneyType::class, [
                'label' => 'Prijs afstand hond ouder dan 1 jaar',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogUnaffiliatedPuppy', MoneyType::class, [
                'label' => 'Prijs afstand puppy (jonger dan 3 maanden)',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogUnaffiliatedAdditionNotChipped', MoneyType::class, [
                'label' => 'Prijs afstand hond toeslag niet gechipt',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogUnaffiliatedAdditionNotVaccinated', MoneyType::class, [
                'label' => 'Prijs afstand hond toeslag vaccinatie nodig',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogUnaffiliatedAdditionFurTreatmentSmallDog', MoneyType::class, [
                'label' => 'Prijs afstand hond toeslag vacht behandeling kleine hond',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogUnaffiliatedAdditionFurTreatmentLargeDog', MoneyType::class, [
                'label' => 'Prijs afstand hond toeslag vacht behandeling grote hond',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogUnaffiliatedAdditionIll', MoneyType::class, [
                'label' => 'Prijs afstand hond toeslag ziek',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogAffiliatedYoungerThanOne', MoneyType::class, [
                'label' => 'Prijs afstand hond jonger dan 1',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogAffiliatedOlderThanOne', MoneyType::class, [
                'label' => 'Prijs afstand hond ouder dan 1 jaar',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogAffiliatedPuppy', MoneyType::class, [
                'label' => 'Prijs afstand puppy (jonger dan 3 maanden)',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogAffiliatedAdditionNotChipped', MoneyType::class, [
                'label' => 'Prijs afstand hond toeslag niet gechipt',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogAffiliatedAdditionNotVaccinated', MoneyType::class, [
                'label' => 'Prijs afstand hond toeslag geen vaccinaties',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogAffiliatedAdditionFurTreatmentSmallDog', MoneyType::class, [
                'label' => 'Prijs afstand hond toeslag vachtbehandeling kleine hond',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogAffiliatedAdditionFurTreatmentLargeDog', MoneyType::class, [
                'label' => 'Prijs afstand hond toeslag vachtbehandeling grote hond',
                'scale' => 0,
            ])
            ->add('priceAbandonedDogAffiliatedAdditionIll', MoneyType::class, [
                'label' => 'Prijs afstand hond toeslag ziek',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatUnaffiliatedYoungerThanThreeMonths', MoneyType::class, [
                'label' => 'Prijs afstand kat jonger dan 3 maanden',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatUnaffiliatedBetweenThreeMonthsAndTenYears', MoneyType::class, [
                'label' => 'Prijs afstand kat tussen 3 maanden en 10 jaar',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatUnaffiliatedOlderThanTenYears', MoneyType::class, [
                'label' => 'Prijs afstand kat ouder dan 10 jaar',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatUnaffiliatedKitten', MoneyType::class, [
                'label' => 'Prijs afstand kitten (jonger dan 1 maand)',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatUnaffiliatedAdditionNotChipped', MoneyType::class, [
                'label' => 'Prijs afstand kat toeslag niet gechipt',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatUnaffiliatedAdditionNotVaccinated', MoneyType::class, [
                'label' => 'Prijs afstand kat toeslag vaccinatie',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatUnaffiliatedAdditionNeedsSterilization', MoneyType::class, [
                'label' => 'Prijs afstand kat toeslag steralisatie',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatAffiliatedYoungerThanThreeMonths', MoneyType::class, [
                'label' => 'Prijs afstand kat jonger dan 3 maanden',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatAffiliatedBetweenThreeMonthsAndTenYears', MoneyType::class, [
                'label' => 'Prijs afstand kat tussen 3 maanden en 10 jaar',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatAffiliatedOlderThanTenYears', MoneyType::class, [
                'label' => 'Prijs afstand kat ouder dan 10 jaar',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatAffiliatedKitten', MoneyType::class, [
                'label' => 'Prijs afstand kitten (jonger dan 1 maand)',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatAffiliatedAdditionNotChipped', MoneyType::class, [
                'label' => 'Prijs afstand kat toeslag niet gechipt',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatAffiliatedAdditionNotVaccinated', MoneyType::class, [
                'label' => 'Prijs afstand kat toeslag vaccinatie',
                'scale' => 0,
            ])
            ->add('priceAbandonedCatAffiliatedAdditionNeedsSterilization', MoneyType::class, [
                'label' => 'Prijs afstand kat toeslag steralisatie',
                'scale' => 0,
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Asiel\BackendBundle\Entity\BookkeepingSettings'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asiel_backendbundle_bookkeepingsettings';
    }


}
