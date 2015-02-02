<?php
namespace BootgridDataModule;

return [
    'router' => [
        'routes' => [
        	'bootgrid-data' => [
        		'type' => 'Segment',
        		'options' => [
        			'route' => '/bootgrid-data[/:entity]',
        			'defaults' => [
        				'__NAMESPACE__' => 'BootgridDataModule\Controller',
        				'controller' => 'BootgridData',
        				'action' => 'data-provider',
        			]
        		]
       		]
        ]
    ],
    'controllers' => [
        'invokables' => [
        	'BootgridDataModule\Controller\BootgridData' => 'BootgridDataModule\Controller\BootgridDataController'
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ]
    ]
];
