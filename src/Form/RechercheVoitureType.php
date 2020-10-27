<?php

namespace App\Form;

use App\Entity\RechercheVoiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheVoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minAnnee', IntegerType::class, [
                "required" =>false,
               // "label" => "Année de: ",
                "attr" => array('placeholder' => 'Année Min')
            ])

            ->add('maxAnnee', IntegerType::class, [
                "required" =>false,
                //"label" => "Année à: ",
               "attr" => array('placeholder' => 'Année Max')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RechercheVoiture::class,
        ]);
    }
}
