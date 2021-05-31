<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Positive;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference', NumberType::class, [
                'constraints' => [
                    new Positive([
                        "message" => "Le chiffre doit être positif",
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Renseignez un prix supérieur à 1',
                    ]),
                ]
            ])
            ->add('titre')
            ->add('categories', EntityType::class, [
                "class" => Categories::class,
                "choice_label" => "name",
                "label" => "Catégorie",
                'required' => true
            ])
            ->add('description')
            ->add('photo', FileType::class, [
                'required' => true,
                'mapped' => false
            ])

            ->add('prix', NumberType::class, [
                'constraints' => [
                    new Positive([
                        "message" => "Le chiffre doit être positif",
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Renseignez un prix supérieur à 1',
                    ]),
                ]
            ])
            ->add('origine_site');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
