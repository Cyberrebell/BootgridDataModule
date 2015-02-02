<?php

namespace BootgridDataModule;

class Module
{
    function getConfig() {
        return require __DIR__ . '/config/module.config.php';
    }
    
    function getAutoloaderConfig() {
    	return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				]
			]
    	];
    }
}
