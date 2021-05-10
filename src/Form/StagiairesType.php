<?php

namespace App\Form;

use App\Entity\Stagiaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StagiairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('adresse')
            ->add('telephone')
            ->add('email')
            ->add('formation')
            ->add('campus')
            ->add('promotion')
            ->add('isActif')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaires::class,
        ]);
    }
}
