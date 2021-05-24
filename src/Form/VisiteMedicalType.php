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

class VisiteMedicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_visite', DateType::class, [
                "widget" => "single_text",
                "label" => "Date de la visite",
            ])
            ->add('symptome', TextType::class, [])
            ->add('diagnostique',  TextType::class, [])
            ->add('analyses',  TextType::class, [])
            ->add('specialiste', EntityType::class, [
                "class" => Specialiste::class,
                "placeholder" => "Nom du Specialiste",
                "choice_label" => "Nom",
                "label" => \false,
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
