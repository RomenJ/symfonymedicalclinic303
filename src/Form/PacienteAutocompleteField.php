<?php

namespace App\Form;

use App\Entity\Paciente;
use App\Repository\PacienteRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class PacienteAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Paciente::class,
            'placeholder' => 'Seleccione su paciente/a',
            //'choice_label' => 'name',

            'query_builder' => function(PacienteRepository $pacienteRepository) {
                return $pacienteRepository->createQueryBuilder('paciente');
            },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
