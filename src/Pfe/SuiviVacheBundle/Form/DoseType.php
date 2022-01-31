<?php

namespace Pfe\SuiviVacheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DoseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dose', TextType::class, [
                'required' => true,
                'label' => 'Dose',
                'attr' => [
                    'placeholder' => 'Dose',
                    'rows'=>5
                ]
            ])
            ->add('medicament', EntityType::class, [
                'class' => 'PfeSuiviVacheBundle:Medicament',
                'choice_label' => 'designation',
                'placeholder' => 'Tous',
                'label' => 'Medicament',
                'required' => true,
            ])        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\SuiviVacheBundle\Entity\Dose'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pfe_suivivachebundle_consultation';
    }


}
