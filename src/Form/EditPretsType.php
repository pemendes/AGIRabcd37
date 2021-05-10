<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Prets;
use App\Repository\ArticlesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPretsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isReturned', checkboxType::class, [
                'label' => 'Retourné',
                'required' => false,
            ])
            ->add('commentaireDebut', TextareaType::class,[
                "label" => 'Commentaire',
                "required" => true
            ])
            ->add('commentaireFin', TextareaType::class,[
                "label" => 'Commentaire au retour',
                "required" => false
            ])
            ->add('validation', CheckboxType::class,[
                "label" => 'Validé',
                "required" => true
            ])
            ->add('stagiaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prets::class,
        ]);
    }
}
