<?php

namespace Pfe\SuiviVacheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Pfe\SuiviVacheBundle\Entity\Medicament;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MedicamentType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {$medicament=new Medicament();
        $builder->add('categorie',ChoiceType::class,[
            'label'=>'Catégorie',
            'choices'=>array_flip($medicament->getListeCategorieMedicament()),
            'multiple'=>false,
            'expanded'=>false,
            'required'=>true,
            'placeholder'=>'Catégorie'

        ])
            ->add('designation');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pfe\SuiviVacheBundle\Entity\Medicament'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pfe_suivivachebundle_medicament';
    }


}
