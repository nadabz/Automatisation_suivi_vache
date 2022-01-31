<?php

namespace Pfe\SuiviVacheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('qteADistribuer', TextType::class, [
            'required' => true,
            'label' => 'Quantité a distribuer',
            'attr' => [
                'placeholder' => 'Quantité a distribuer',
                'autocomplete' => 'off',
            ]
        ])
            ->add('typeVache', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:TypeVache',
                'choice_label' => 'Type',
                'placeholder' => 'Tous',
                'label' => 'Type vache',
                'required' => true,
            ])
            ->add('race', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:Race',
                'choice_label' => 'libelle',
                'placeholder' => 'Tous',
                'label' => 'Race',
                'required' => true,
            ])


            ->add('trancheAge', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:TrancheAge',
                'choice_label' => 'libTrancheAge',
                'placeholder' => 'Tous',
                'label' => 'Tranche age',
                'required' => true,
            ])
            ->add('aliment', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:Aliment',
                'choice_label' => 'code_designation',
                'placeholder' => 'Aliment',
                'label' => 'Aliment',
                'required' => true,
            ]);





    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\SuiviVacheBundle\Entity\Ration'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pfe_suivivachebundle_ration';
    }


}
