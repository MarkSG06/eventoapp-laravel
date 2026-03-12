<?php

namespace App\ViewModels\Admin;

final class LanguageViewModel
{
    static public function tableStructure()
    {
        return [
            'columns' => [
                'name' => 'Nombre',
                'label' => 'Etiqueta',
                'active' => 'Activo',
            ],
            'filters' => [
                ['name' => 'name', 'type' => 'text', 'label' => 'Nombre', 'width' => 'full-width'],
                ['name' => 'label', 'type' => 'text', 'label' => 'Etiqueta', 'width' => 'full-width'],
            ],
            'tableButtons' => ['filterButton'],
            'elementEndpoint' => 'languages_edit',
            'endpoint' => 'languages'
        ];
    }

    static public function formStructure()
    {
        return [
            'tabs' => [
                ['name' => 'general', 'label' => 'General'],
            ],
            'formButtons' => [
                'destroyButton' => 'languages_destroy',
                'createButton' => 'languages_create',
                'storeButton' => 'languages_store',
            ],
            'inputs' => [
                'general' => [
                    ['name' => 'name', 'type' => 'text', 'label' => 'Nombre', 'width' => 'half-width'],
                    ['name' => 'label', 'type' => 'text', 'label' => 'Etiqueta', 'width' => 'half-width'],
                    ['name' => 'active', 'type' => 'checkbox', 'label' => 'Activo', 'width' => 'half-width'],
                ],
            ]
        ];
    }
}