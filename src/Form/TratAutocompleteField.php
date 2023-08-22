<?php

namespace App\Form;

use App\Entity\Trat;
use App\Repository\TratRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class TratAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Trat::class,
            'placeholder' => 'Seleccione uno o varios tratamientos',
            //'choice_label' => 'name',
            'multiple' => true,
            'query_builder' => function(TratRepository $tratRepository) {
                return $tratRepository->createQueryBuilder('trat');
            },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
