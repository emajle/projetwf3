<?php

namespace App\Form;

use App\Entity\Specialiste;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class SpecialisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [])
            ->add('prenom', TextType::class, [])
            ->add('profession', ChoiceType::class, [
                "choices" => [
                    "Vétérinaire" => "veterinaire",
                    "Comportementaliste animalier" => "comportementaliste animalier",
                    "Educateur " => "educateur ",
                    "Eleveur " => "eleveur ",
                    "Ostéopathe animalier" => "osteopathe animalier",
                    "Psychologue" => "psychologue",
                    "Autre" => "autre"
                ],
                'placeholder' => '',
            ])
            ->add('telephone', TelType::class, [])
            ->add('email', EmailType::class, [])
            ->add('adresse', TextType::class, [])
            ->add('ville', TextType::class, [])
            ->add('cp', NumberType::class, [
                'constraints' => [
                    new Positive([
                        'message' => "doit etre un chiffre possitif"
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 5,
                        'minMessage' => 'un code postal est composé de 5 chiffre',
                        'maxMessage' => 'un code postal est composé de 5 chiffre'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Specialiste::class,
        ]);
    }
}
