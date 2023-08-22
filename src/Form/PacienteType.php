<?php

namespace App\Form;

use App\Entity\Paciente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PacienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('surname')
           
            ->add('dateborn', DateType::class, [
                'label' => 'Fecha de nacimiento',
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Día',
                    
                ],
                'years' => range(1910, date('Y')),
                'html5' => false,
                'format' => 'dd-MM-yyyy',
                'attr' => [
                   
                    'min' => '1900-01-01',
                    'max' => date('Y-m-d')
                ]
            ])


            ->add('dni')
            ->add('telefono')
            ->add('direccion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paciente::class,
        ]);
    }
}
