<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', options: [
                "label" => "Nom de la voiture"
            ])
            ->add('description')
            ->add('prixQuotidien', NumberType::class, [
                "label" => "Prix journalier",
            ])
            ->add('prixMensuel')
            ->add('places', ChoiceType::class, [
                "label" => "Nombre de places",
                "choices" => range(1, 9, 1),
                "choice_label" => function ($choice) {
                    return $choice;
                },
            ])
            ->add('manuelle', ChoiceType::class, [
                "label" => "Boîte de vitesse",
                "choices" => [
                    "Manuelle" => true,
                    "Automatique" => false,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
