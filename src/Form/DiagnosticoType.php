<?php

namespace App\Form;

use App\Entity\Diagnostico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Pato;
use App\Entity\User;
use App\Entity\Prueba;
use App\Entity\Trat;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DiagnosticoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          //  ->add('date')
            ->add('notas')
            
            //->add('paciente')

            ->add('medico',EntityType::class, [
                // looks for choices from this entity
                'class' => User::class,
                // used to render a select box, check boxes or radios
                 'multiple' => true,
                 'expanded' => true,
            ])

            ->add('paciente', PacienteAutocompleteField::class)
        //    ->add('patologias', )

        ->add('patologias', PatoAutocompleteField::class)

        /*
            ->add('patologias',EntityType::class, [
                // looks for choices from this entity
                'class' => Pato::class,
                // used to render a select box, check boxes or radios
                 'multiple' => true,
                 'expanded' => true,
            ])
*/
            ->add('Pruebas', PruebaAutocompleteField::class)
            /*->add('pruebas',EntityType::class, [
                // looks for choices from this entity
                'class' => Prueba::class,
                // used to render a select box, check boxes or radios
                 'multiple' => true,
                 'expanded' => true,
            ])*/

         ->add('trats', TratAutocompleteField::class)
/*
        ->add('trats',EntityType::class, [
                // looks for choices from this entity
                'class' => Trat::class,
                // used to render a select box, check boxes or radios
                 'multiple' => true,
                 'expanded' => true,
            ])*/

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Diagnostico::class,
        ]);
    }
}
