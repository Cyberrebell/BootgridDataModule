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
       		],
        	'bootgrid' => [
        		'type' => 'Segment',
        		'options' => [
        			'route' => '/bootgrid[/:entity[/:action[/:id]]]',
        			'defaults' => [
        				'__NAMESPACE__' => 'BootgridDataModule\Controller',
        				'controller' => 'Bootgrid',
        				'action' => 'list'
        			]
        		]
       		]
        ]
    ],
    'controllers' => [
        'invokables' => [
        	'BootgridDataModule\Controller\BootgridData' => 'BootgridDataModule\Controller\BootgridDataController',
        	'BootgridDataModule\Controller\Bootgrid' => 'BootgridDataModule\Controller\BootgridController'
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ]
    ]
];
