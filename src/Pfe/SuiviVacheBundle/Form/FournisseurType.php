<?php

namespace Pfe\SuiviVacheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FournisseurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('code',TextType::class, [
            'required' => false,
            'label' => 'Code',
            'attr' => [
                'placeholder' => 'Code',
            ]
        ])

        ->add('nom',TextType::class, [
            'required' => false,
            'label' => 'Nom',
            'attr' => [
                'placeholder' => 'Nom',
            ]
        ])

            ->add('adresse',TextType::class, [
        'required' => false,
        'label' => 'Adresse',
        'attr' => [
            'placeholder' => 'Adresse',
        ]
    ])

            ->add('tel',TextType::class, [
        'required' => false,
        'label' => 'Télephone',
        'attr' => [
            'placeholder' => 'Télephone',
        ]
    ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\SuiviVacheBundle\Entity\Fournisseur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pfe_suivivachebundle_fournisseur';
    }


}
