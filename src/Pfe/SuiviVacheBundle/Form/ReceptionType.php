<?php

namespace Pfe\SuiviVacheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReceptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateReception', DateType::class, [
                'label' => 'Date reception',
                'required' => false,
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => [
                    'class' => 'datepicker',
                    'placeholder' => 'Date de réception',
                    'autocomplete' => 'off'
                ]
            ])
            ->add('aliment', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:Aliment',
                'choice_label' => 'code_designation',
                'placeholder' => 'Tous',
                'label' => 'Aliment',
                'required' => false,
            ])
            ->add('fournisseur', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:Fournisseur',
                'choice_label' => 'nom',
                'placeholder' => 'Tous',
                'label' => 'Fournisseur',
                'required' => false,
            ])

            ->add('qteReception', TextType::class, [
                'required' => false,
                'label' => 'quantité reçue',
                'attr' => [
                    'placeholder' => 'quantité reçue',
                    'autocomplete' => 'off'
                    ]
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\SuiviVacheBundle\Entity\Reception'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pfe_suivivachebundle_reception';
    }


}
