<?php

namespace App\Form;


use App\Entity\User;
use App\Entity\Animal;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            // ->add('membre', EntityType::class, [
            //     "class" => User::class,
            //     "choice_label" => "Pseudo",
            //     "required" => false,
            //     "label" => "Membre"
            // ])

            ->add('prenom', TextType::class)
            ->add('espece', ChoiceType::class, [

                'label' => "Espece",
                'placeholder' => 'Espèce',
                "choices" => [
                    "chien" => "chien",
                    "chat" => "chat"
                ],
                'multiple' => false
            ])
            ->add('couleur', TextType::class)
            ->add('age', NumberType::class)
            ->add('sexe', ChoiceType::class, [
                "choices" => [
                    "male" => "m",
                    "femelle" => "f"
                ],
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'mapped' => \false,
                'multiple' => true,

            ])
            ->add('description', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
