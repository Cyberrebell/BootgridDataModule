<?php
namespace BootgridDataModule;

return [
    'router' => [
        'routes' => [
        	'user' => [
        		'type' => 'Segment',
        		'options' => [
        			'route' => '/bootgrid-data[/:entity]',
        			'defaults' => [
        				'__NAMESPACE__' => 'BootgridDataModule\Controller',
        				'controller' => 'BootgridData',
        				'action' => 'data-provider',
        			],
        		],
        		'may_terminate' => true
       		]
        ]
    ],
    'controllers' => [
        'invokables' => [
        	'BootgridDataModule\Controller\BootgridData' => 'BootgridDataModule\Controller\BootgridDataController'
        ],
    ],
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    )
];
