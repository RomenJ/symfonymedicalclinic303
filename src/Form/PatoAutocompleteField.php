<?php

namespace App\Form;

use App\Entity\Pato;
use App\Repository\PatoRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class PatoAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Pato::class,
            'placeholder' => 'Seleccione una patología',
            //'choice_label' => 'name',
            'multiple' => true,
            'query_builder' => function(PatoRepository $patoRepository) {
                return $patoRepository->createQueryBuilder('pato');
            },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
