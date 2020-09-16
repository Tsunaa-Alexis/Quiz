<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NewAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('ajouter')
            ->add('categorie', EntityType::class, array(
                'class'        => 'App\Entity\Categorie',
                'choice_label' => 'catName',
            ))
        ;
    }

    public function getParent()
    {
        return AnnonceType::class;
    }
}
