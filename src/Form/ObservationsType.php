<?php

namespace App\Form;

use App\Entity\Observations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
                    'html5' => false
                ))
            ->add('aTemp', TextType::class)
            ->add('aHum', NumberType::class)
            ->add('bTemp', TextType::class)
            ->add('bHum', IntegerType::class)
            ->add('extTemp', TextType::class)
            ->add('extHum', IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Observations::class,
            'csrf_protection' => false
        ]);
    }
}
