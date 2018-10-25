<?php

namespace App\Form;

use App\Entity\RendezVous;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class RendezVousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateType::class,['label'=>'Date du rendez-vous','attr'=> ['class'=>'col-lg-12 form-control','type'=>'date']])
            ->add('heure',TimeType::class,['label'=>'Heure du rendez-vous','attr'=> ['class'=>'col-lg-12 form-control','type'=>'date']])
            ->add('description',TextType::class,['label'=>'Description du rendez-vous','attr'=> ['class'=>'col-lg-12 form-control','type'=>'date']])
            ->add('user',null,['label'=>'Assistant du rendez-vous','attr'=> ['class'=>'col-lg-12 form-control','style'=>'margin-bottom:20px;']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
