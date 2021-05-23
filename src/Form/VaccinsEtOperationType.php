<?php

namespace App\Form;

use App\Entity\CarnetSante;
use App\Entity\Specialiste;
use App\Entity\VaccinsEtOperation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VaccinsEtOperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('action', ChoiceType::class, [
                "choices" => [
                    "Opération" => "operation",
                    "Vaccination" => "vaccimation"
                ]
            ])
            ->add('description', TextType::class)
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
            'data_class' => VaccinsEtOperation::class,
        ]);
    }
}
