<?php

namespace Pfe\SuiviVacheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Pfe\SuiviVacheBundle\Form\VacheCollectionType;

class LotType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbreVache', TextType::class, [
            'required' => false,
            'label' => 'Nombre des vaches',
            'attr' => [
                'placeholder' => 'Numéro',
                'autocomplete' => 'off',
                'value'=>8,
                'readonly'=>''
            ]
        ])
            ->add('numLot', TextType::class, [
                'required' => false,
                'label' => 'Numéro',
                'attr' => [
                    'placeholder' => 'Numéro',
                    'autocomplete' => 'off',
                    'readonly'=>''
                ]
            ])
            ->add('typeVache', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:TypeVache',
                'choice_label' => 'Type',
                'placeholder' => 'Tous',
                'label' => 'Type vache',
                'required' => false,
            ])
            ->add('trancheAge', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:TrancheAge',
                'choice_label' => 'libTrancheAge',
                'placeholder' => 'Tous',
                'label' => 'Tranche age',
                'required' => false,
            ])
            ->add('race', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:Race',
                'choice_label' => 'libelle',
                'placeholder' => 'Tous',
                'label' => 'Race',
                'required' => false,
            ])
            ->add('etable', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:Etable',
                'choice_label' => 'numero',
                'placeholder' => 'Tous',
                'label' => 'Etable',
                'required' => false,
            ])
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\SuiviVacheBundle\Entity\Lot'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pfe_suivivachebundle_lot';
    }


}
