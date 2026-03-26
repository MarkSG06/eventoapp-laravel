<?php

namespace App\ViewModels\Admin;

final class FaqViewModel
{
    static public function tableStructure()
    {
        return [
            'columns' => [
                'question' => 'Pregunta',
                'answer' => 'Respuesta',
            ],
            'filters' => [
                ['name' => 'question', 'type' => 'text', 'label' => 'Pregunta', 'width' => 'full-width'],
            ],
            'tableButtons' => ['filterButton'],
            'elementEndpoint' => 'faqs_edit',
            'endpoint' => 'faqs'
        ];
    }

    static public function formStructure()
    {
        return [
            'tabs' => [
                ['name' => 'general', 'label' => 'General'],
            ],
            'formButtons' => [
                'destroyButton' => 'faqs_destroy',
                'createButton' => 'faqs_create',
                'storeButton' => 'faqs_store',
            ],
            'inputs' => [
								'general' => [
										'locale' => [
											['name' => 'question', 'type' => 'text', 'label' => 'Pregunta', 'width' => 'full-width'],
											['name' => 'answer', 'type' => 'text', 'label' => 'Respuesta', 'width' => 'full-width'],
										]
								]
						]
        ];
    }
}