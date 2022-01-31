<?php

namespace Pfe\SuiviVacheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AlimentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('code', TextType::class, [
            'required' => false,
            'label' => 'Code',
            'attr' => [
                'placeholder' => 'code',
                'autocomplete' => 'off'

            ]
        ])
            ->add('designation', TextType::class, [

                'required' => false,
                'label' => 'Désignation',
                'attr' => [
                    'placeholder' => 'désignation',
                    'autocomplete' => 'off'
                ]
            ])
            ->add('qteStock', TextType::class, [

                'required' => false,
                'label' => 'Quantité en stock',
                'attr' => [
                    'placeholder' => 'Quantité en stock',
                    'autocomplete'=>'off'
                ]
            ])
            ->add('qteMin', TextType::class, [

                'required' => false,
                'label' => 'Quantité minimale',
                'attr' => [
                    'placeholder' => 'Quantité minimale',
                    'autocomplete'=>'off'
                ]
            ]);


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\SuiviVacheBundle\Entity\Aliment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pfe_suivivachebundle_aliment';
    }


}
