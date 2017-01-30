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

class SearchAnimalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Kat' => 'cat',
                    'Hond' => 'dog',
                ],
                'choice_attr' => function ($val, $key, $index) {
                    return ['class' => $val];
                },
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('gender', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Mannelijk' => 'male',
                    'Vrouwelijk' => 'female',
                    'Onbekend' => 'unknown'
                ],
                'choice_attr' => function ($val, $key, $index) {
                    return ['class' => $val];
                },
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('agestart', ChoiceType::class, [
                'label' => false,
                'choices' => $this->generateAgeNumbers(),
                'multiple' => false,
            ])
            ->add('ageend', ChoiceType::class, [
                'label' => false,
                'choices' => $this->generateAgeNumbers(),
                'multiple' => false,
                'data'  => 18,
            ])
            ->add('status', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Afgestaan' => 'abandoned',
                    'Gevonden' => 'found',
                    'In beslag genomen' => 'seized'
                ],
                'choice_attr' => function ($val, $key, $index) {
                    return ['class' => $val];
                },
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('sterilized', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Ja' => 'sterilized',
                ],
                'choice_attr' => function ($val, $key, $index) {
                    return ['class' => $val];
                },
                'expanded' => true,
                'multiple' => true,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'mapped' => false,
            'required' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        // JS will break if you change this
        return 'frontendbundle_search_animal';
    }

    private function generateAgeNumbers()
    {
        for ($i = 1; $i <= 18; $i++) {
            $result[$i] = $i;
        }

        return $result;
    }

}
