<?php

namespace App\Form;

use App\Entity\CarnetSante;
use App\Entity\Specialiste;
use App\Entity\VisiteMedical;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiteMedicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_visite')
            ->add('symptome')
            ->add('diagnostique')
            ->add('analyses')
            ->add('specialiste', EntityType::class, [
                "class" => Specialiste::class,
                "choice_label" => "Nom",
                "label" => "Nom"
            ])
            ->add('carnet', EntityType::class, [
                "class" => CarnetSante::class,
                "choice_label" => "animal.prenom",
                "label" => "Nom"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VisiteMedical::class,
        ]);
    }
}
