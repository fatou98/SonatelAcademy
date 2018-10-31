<?php

namespace App\Form;

use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('prenom', TextType::class,['attr'=> ['class'=>'col-lg-6 form-control','style'=>'margin-bottom:10px;']])
        ->add('nom', TextType::class,['attr'=> ['class'=>'col-lg-6 form-control','style'=>'margin-bottom:10px;']])
        ->add('dateofbirth', null,['attr'=> ['class'=>'col-lg-6 form-control','type'=>'date','style'=>'margin-bottom:10px;']])
        ->add('lieunaissance', TextType::class,['attr'=> ['class'=>'col-lg-6 form-control','style'=>'margin-bottom:10px;']])
        ->add('numpiece', NumberType::class,['attr'=> ['class'=>'col-lg-6 form-control','style'=>'margin-bottom:10px;']])
        ->add('mobileNumber', NumberType::class,['attr'=> ['class'=>'col-lg-6 form-control','style'=>'margin-bottom:10px;']])
        ->add('fixNumber', NumberType::class,['attr'=> ['class'=>'col-lg-6 form-control','style'=>'margin-bottom:10px;']])
        ->add('adresse', TextType::class,['attr'=> ['class'=>'col-lg-6 form-control','style'=>'margin-bottom:10px;']])
        ->add('email', EmailType::class,['attr'=> ['class'=>'col-lg-6 form-control','style'=>'margin-bottom:10px;']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
