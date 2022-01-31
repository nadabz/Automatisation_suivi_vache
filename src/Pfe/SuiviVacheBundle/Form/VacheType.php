<?php

namespace Pfe\SuiviVacheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VacheType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('age', TextType::class, [
            'required' => false,
            'label' => 'Age',
            'attr' => [
                'placeholder' => 'Age',
                'autocomplete' => 'off'
            ]
        ])
            ->add('numero', TextType::class, [
                'required' => false,
                'label' => 'Numéro',
                'attr' => [
                    'placeholder' => 'Numéro',
                    'autocomplete' => 'off',
                    'readonly'=>''
                ]
            ])
            ->add('poidNaissance', TextType::class, [
                'required' => false,
                'label' => 'Poids de naissance',
                'attr' => [
                    'placeholder' => 'Poids de naissance',
                    'autocomplete' => 'off'
                ]
            ])
            ->add('dateNaissance',DateType::class,[
                'label'=>'Date de naissance',
                'required'=>false,
                'widget'=>'single_text',
                'format'=>'dd-MM-yyyy',
                'attr'=>[
                    'class'=>'datepicker',
                    'placeholder' => 'Date de naissance',
                    'autocomplete' => 'off'
                ]
            ])

            ->add('vacheMere', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:Vache',
                'choice_label' => 'numero',
                'placeholder' => 'Tous',
                'label' => 'Vache mère',
                'required' => false,
            ])
            ->add('fournisseur', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:Fournisseur',
                'choice_label' => 'nom',
                'placeholder' => 'Tous',
                'label' => 'Fournisseur',
                'required' => false,
            ])
            ->add('typeVache', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:TypeVache',
                'choice_label' => 'type',
                'placeholder' => 'Tous',
                'label' => 'Type Vache',
                'required' => false,
            ])

            ->add('race', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:Race',
                'choice_label' => 'libelle',
                'placeholder' => 'Tous',
                'label' => 'Race',
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\SuiviVacheBundle\Entity\Vache'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pfe_suivivachebundle_vache';
    }


}
