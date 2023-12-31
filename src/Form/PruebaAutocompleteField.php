<?php

namespace App\Form;

use App\Entity\Prueba;
use App\Repository\PruebaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class PruebaAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Prueba::class,
            'placeholder' => 'Selecciona una o varias pruebas',
            //'choice_label' => 'name',
            'multiple' => true,
            'query_builder' => function(PruebaRepository $pruebaRepository) {
                return $pruebaRepository->createQueryBuilder('prueba');
            },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
