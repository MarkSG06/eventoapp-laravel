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
              ['name' => 'avatar', 'label' => 'Avatar'],
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
                ],
              ],
              'avatar' => [
                'locale' => [
                  ['name' => 'poster', 'type' => 'gallery', 'label' => 'Poster del evento', 'quantity' => 'single', 'width' => 'full-width', 
										'configuration' => [
											'thumbnail' => [
												'widthPx' => '100',
												'heightPx' => '100'
											],
											'xs' => [
												'widthPx' => '200',
												'heightPx' => '200'
											],
											'sm' => [
												'widthPx' => '200',
												'heightPx' => '200'
											],
											'md' => [
												'widthPx' => '450',
												'heightPx' => '450'
											],
											'lg' => [
												'widthPx' => '450',
												'heightPx' => '450'
											]
										]
									],
                ],
              ],
          ]
      ];
  }
}