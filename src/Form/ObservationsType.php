<?php

namespace App\Form;

use App\Entity\Observations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('time', DateTimeType::class,
                [
                    "contraints" => new NotBlank(),
                    "format" => "yyyy-MM-dd HH:mm:ss"
                ])
            ->add('aTemp', NumberType::class,
                [
                    "contraints" => new NotBlank()
                ])
            ->add('aHum', IntegerType::class,
                [
                    "contraints" => new NotBlank()
                ])
            ->add('bTemp', NumberType::class,
                [
                    "contraints" => new NotBlank()
                ])
            ->add('bHum', IntegerType::class,
                [
                    "contraints" => new NotBlank()
                ])
            ->add('extTemp', NumberType::class,
                [
                    "contraints" => new NotBlank()
                ])
            ->add('extHum', IntegerType::class,
                [
                    "contraints" => new NotBlank()
                ]);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Observations::class,
            'csrf_protection' => false
        ]);
    }
}
