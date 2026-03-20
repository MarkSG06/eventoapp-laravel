<?php

namespace App\ViewModels\Admin;

final class TicketViewModel
{
    static public function tableStructure()
    {
        return [
            'columns' => [
                'fiscal_name' => 'Nombre Fiscal',
                'ticket_number' => 'Número de ticket',
                'datetime' => 'Fecha',
                'total_after_tax' => 'Total',
            ],
            'filters' => [
                ['name' => 'fiscal_name', 'type' => 'text', 'label' => 'Nombre', 'width' => 'full-width'],
                ['name' => 'datetime', 'type' => 'datetime-local', 'label' => 'Fecha', 'width' => 'full-width'],
            ],
            'tableButtons' => ['filterButton'],
            'elementEndpoint' => 'tickets_edit',
            'endpoint' => 'tickets'
        ];
    }

    static public function formStructure()
    {
        return [
            'tabs' => [
                ['name' => 'general', 'label' => 'General'],
                ['name' => 'images', 'label' => 'Imágenes'],
                // ['name' => 'camera', 'label' => 'Cámara']
            ],
            'formButtons' => [
                'destroyButton' => 'tickets_destroy',
                'createButton' => 'tickets_create',
                'storeButton' => 'tickets_store',
            ],
            'inputs' => [
								'general' => [
										'noLocale' => [
											['name' => 'fiscal_name', 'type' => 'text', 'label' => 'Nombre Fiscal', 'width' => 'half-width'],
											['name' => 'nif', 'type' => 'text', 'label' => 'NIF', 'width' => 'half-width'],
											['name' => 'datetime', 'type' => 'datetime-local', 'label' => 'Fecha', 'width' => 'half-width'],
											['name' => 'ticket_number', 'type' => 'number', 'label' => 'Número de ticket', 'width' => 'half-width'],
											['name' => 'tax_amount', 'type' => 'number', 'label' => 'Importe de impuestos', 'width' => 'one-quarter-width'],
											['name' => 'total_before_tax', 'type' => 'number', 'label' => 'Total antes de impuestos', 'width' => 'one-quarter-width'],
											['name' => 'total_tax', 'type' => 'number', 'label' => 'Total de impuestos', 'width' => 'one-quarter-width'],
											['name' => 'total_after_tax', 'type' => 'number', 'label' => 'Total después de impuestos', 'width' => 'one-quarter-width'],
										],
										'locale' => [
											['name' => 'title', 'type' => 'text', 'label' => 'Título', 'width' => 'full-width'],
											['name' => 'notes', 'type' => 'textarea', 'label' => 'Notas', 'width' => 'full-width'],
										],
								],
								'images' => [
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
												['name' => 'gallery', 'type' => 'gallery', 'label' => 'Galería del evento', 'quantity' => 'multiple', 'width' => 'full-width', 
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
												]
										]
                ],
								// 'camera' => [
								// 		'noLocale' => [
								// 			['name' => 'image', 'type' => 'camera', 'buttonText' => 'Subir', 'label' => '', 'width' => 'minimum-width'],
								// 		]
								// ],
						]
        ];
    }
}