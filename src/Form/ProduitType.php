<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('titre')
            ->add('categories', EntityType::class, [
                "class" => Categories::class,
                "choice_label" => "name",
                "label" => "Catégorie",
                'required' => false
            ])
            ->add('description')
            ->add('photo', FileType::class, [
                'required' => false,
                'mapped' => false
            ])

            ->add('prix')
            ->add('origine_site');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
