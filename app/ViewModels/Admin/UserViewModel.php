<?php

namespace App\ViewModels\Admin;

final class UserViewModel
{
  static public function tableStructure()
  {
      return [
          'columns' => [
              'name' => 'Nombre',
              'email' => 'Email',
          ],
          'filters' => [
              ['name' => 'name', 'type' => 'text', 'label' => 'Nombre', 'width' => 'full-width'],
              ['name' => 'email', 'type' => 'text', 'label' => 'Email', 'width' => 'full-width'],
          ],
          'tableButtons' => ['filterButton'],
          'elementEndpoint' => 'users_edit',
          'endpoint' => 'users'

      ];
  }

  static public function formStructure()
  {
      return [
          'tabs' => [
              ['name' => 'general', 'label' => 'General'],
          ],
          'formButtons' => [
              'destroyButton' => 'users_destroy',
              'createButton' => 'users_create',
              'storeButton' => 'users_store',
          ],
          'inputs' => [
              'general' => [
              'noLocale' => [
                  ['name' => 'name', 'type' => 'text', 'label' => 'Nombre', 'width' => 'half-width'],
                  ['name' => 'email', 'type' => 'email', 'label' => 'Email', 'width' => 'half-width'],
                  ['name' => 'password', 'type' => 'password', 'label' => 'Contraseña', 'width' => 'half-width'],
                  ['name' => 'password_confirmation', 'type' => 'password', 'label' => 'Confirmar contraseña', 'width' => 'half-width'],
              ]
              ],
          ]
      ];
  }
}