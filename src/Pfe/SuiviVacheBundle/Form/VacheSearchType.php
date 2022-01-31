<?php

namespace Pfe\SuiviVacheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VacheSearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', TextType::class, [
                'required' => false,
                'label' => 'Numéro',
                'attr' => [
                    'placeholder' => 'Numéro',
                    'autocomplete' => 'off',
                ]
            ])
            ->add('ageMin', TextType::class, [
                'required' => false,
                'label' => 'Age min',
                'attr' => [
                    'placeholder' => 'Age min',
                    'autocomplete' => 'off',
                ]
            ])
            ->add('ageMax', TextType::class, [
                'required' => false,
                'label' => 'Age max',
                'attr' => [
                    'placeholder' => 'Age max',
                    'autocomplete' => 'off',
                ]
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'search_vache';
    }


}
