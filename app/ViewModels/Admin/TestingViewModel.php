<?php

namespace App\ViewModels\Admin;

final class TestingViewModel
{
  static public function tableStructure()
  {
      return [
          'columns' => [
              'text' => 'Texto',
              'number' => 'Número',
              'bool' => 'Booleano',
              'datetime' => 'Fecha y hora',
              'select' => 'Select',
              'file' => 'Archivo',
              'textarea' => 'Textarea',
          ],
          'filters' => [
              ['name' => 'text', 'type' => 'text', 'label' => 'Texto', 'width' => 'half-width'],
              ['name' => 'number', 'type' => 'number', 'label' => 'Número', 'width' => 'half-width'],
          ],
          'tableButtons' => ['filterButton'],
          'elementEndpoint' => 'testings_edit',
          'endpoint' => 'testings'

      ];
  }

  static public function formStructure()
  {
      return [
          'tabs' => [
              ['name' => 'general', 'label' => 'General'],
              ['name' => 'image', 'label' => 'Imagen'],
          ],
          'formButtons' => [
              'destroyButton' => 'testings_destroy',
              'createButton' => 'testings_create',
              'storeButton' => 'testings_store',
          ],
          'inputs' => [
                'general' => [ 
                    'noLocale' => [
                        ['name' => 'text', 'type' => 'text', 'label' => 'Texto', 'width' => 'one-third-width'],
                        ['name' => 'number', 'type' => 'number', 'label' => 'Número', 'width' => 'one-third-width'],
                        ['name' => 'datetime', 'type' => 'datetime-local', 'label' => 'Fecha y hora', 'width' => 'one-third-width'],
                        ['name' => 'role', 'type' => 'select', 'label' => 'Rol', 'width' => 'one-third-width', 'options' => [
                            ['value' => 'admin', 'label' => 'Admin'],
                            ['value' => 'user', 'label' => 'User'],
                        ]],
                        ['name' => 'file', 'type' => 'file', 'label' => 'Archivo', 'width' => 'one-third-width'],
                        ['name' => 'textarea', 'type' => 'textarea', 'label' => 'Textarea', 'width' => 'one-third-width'],
                    ],
                    'locale' => [
                        ['name' => 'title', 'type' => 'text', 'label' => 'Título', 'width' => 'full-width'],
                        ['name' => 'description', 'type' => 'textarea', 'label' => 'Descripción', 'width' => 'full-width'],
                    ],
                ],
                'image' => [
										'noLocale' => [
												['name' => 'image', 'type' => 'gallery', 'buttonText' => 'Subir', 'label' => '', 'width' => 'one-third-width'],
										]
                ],
          ]
      ];
  }
}