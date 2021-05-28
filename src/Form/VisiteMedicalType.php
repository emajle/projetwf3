<?php

namespace App\Form;

use App\Entity\CarnetSante;
use App\Entity\Specialiste;
use App\Entity\VisiteMedical;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Choice;

class VisiteMedicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_visite', DateType::class, [
                'format' => 'yyyy-MM-dd',
                "widget" => "single_text",
                "label" => "Date de la visite",
                "placeholder" => "",
            ])
            ->add('nom', TextType::class)
            ->add('action', ChoiceType::class, [
                "placeholder" => "",
                "choices" => [
                    "Visite Medical" => "visite_medical",
                    "Opération" => "operation",
                    "Vaccination" => "vaccimation",

                ]
            ],)
            ->add('symptome', TextType::class, [])
            ->add('diagnostique',  TextType::class, [])
            ->add('analyses',  TextType::class, [])
            ->add('specialiste', EntityType::class, [
                "class" => Specialiste::class,
                "placeholder" => "",

                "choice_label" => "Nom",
                "required" => false,
            ]);
        // ->add('carnet', EntityType::class, [
        //     "class" => CarnetSante::class,
        //     "choice_label" => "animal.prenom",
        //     "label" => "Nom"
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VisiteMedical::class,
        ]);
    }
}
