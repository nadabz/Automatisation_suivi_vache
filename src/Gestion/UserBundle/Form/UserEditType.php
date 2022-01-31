<?php

namespace Gestion\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Gestion\UserBundle\Entity\User;

class UserEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $user = new User();
        
        $builder
                ->add('firstName',TextType::class,[
                    "label"=>"Prénom",
                    "required"=>false,
                    'attr' => [
                        'autocomplete' => 'off',
                        'placeholder' => 'Prénom']])
                ->add('lastName',TextType::class,[
                    "label"=>"Nom",
                    "required"=>false,
                    'attr' => [
                        'autocomplete' => 'off',
                        'placeholder' => 'Nom']])
                ->add('email',TextType::class,[
                    "label"=>"Email",
                    "required"=>false,
                    'attr' => [
                        'autocomplete' => 'off',
                        'placeholder' => 'Email']])
                ->add('username',TextType::class,[
                    "label"=>"Identifiant",
                    "required"=>false,
                    'attr' => [
                        'autocomplete' => 'off',
                        'placeholder' => 'Identifiant']])
                ->add('passwordEdit',PasswordType::class,[
                    "label"=>"Mot de passe",
                    "required"=>false,
                    'attr' => [
                        'autocomplete' => 'off',
                        'placeholder' => 'Mot de passe']])
                ->add('active',CheckboxType::class,array("label"=>"Actif","required"=>false))
                //->add('apikey')
                ->add('roles',ChoiceType::class,
                        [
                            'choices'=>$user->getRoles(),
                            'multiple'=>true,
                            'expanded'=>true
                        ],
                        ['label'=>'Rôles']
                );
    
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\UserBundle\Entity\User'
        ));
    }
}
