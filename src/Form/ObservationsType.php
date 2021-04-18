<?php

namespace App\Form;

use App\Entity\Observations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('time', DateTimeType::class,
                array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd HH:mm:ss',
                    'input' => 'string',
                    'html5' => false
                ))
            ->add('aTemp', TextType::class, [
                "required" => false
            ])
            ->add('aHum', TextType::class, [
                "required" => false
            ])
            ->add('bTemp', TextType::class, [
                "required" => false
            ])
            ->add('bHum', TextType::class, [
                "required" => false
            ])
            ->add('extTemp', TextType::class, [
                "required" => false
            ])
            ->add('extHum', TextType::class, [
                "required" => false
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
