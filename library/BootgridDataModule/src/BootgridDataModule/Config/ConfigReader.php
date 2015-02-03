<?php

namespace BootgridDataModule\Config;

class ConfigReader
{
	protected $config;
	
	/**
	 * @param array $config get the config this way: $this->getServiceLocator()->get('Config')
	 */
	function __construct(array $config) {
		$this->config = $config;
	}
	
	function getEntityNamespace($entity) {
		$entityConfig = $this->getEntityConfig($entity);
		
		if (array_key_exists('namespace', $entityConfig)) {
			return $entityConfig['namespace'];
		} else {
			throw new \Exception('"namespace" entry for entity "' . $entity . '" is not set in "bootgrid-data" config!');
		}
	}
	
	function getSearchableProperties($entity) {
		$entityConfig = $this->getEntityConfig($entity);
		
		if (array_key_exists('searchable', $entityConfig)) {
			return $entityConfig['searchable'];
		} else {
			throw new \Exception('"searchable" entry for entity "' . $entity . '" is not set in "bootgrid-data" config!');
		}
	}
	
	function getPropertyBlacklist($entity) {
		$entityConfig = $this->getEntityConfig($entity);
		
		if (array_key_exists('blacklist', $entityConfig)) {
			return $entityConfig['blacklist'];
		} else {
			throw new \Exception('"blacklist" entry for entity "' . $entity . '" is not set in "bootgrid-data" config!');
		}
	}
	
	protected function getEntityConfig($entity) {
		$bootgridConfig = $this->getBootgridConfig();
		
		if (array_key_exists($entity, $bootgridConfig)) {
			return $bootgridConfig[$entity];
		} else {
			throw new \Exception('entity "' . $entity . '" is not mapped in "bootgrid-data" config!');
		}
	}
	
	protected function getBootgridConfig() {
		if (array_key_exists('bootgrid-data', $this->config)) {
			return $this->config['bootgrid-data'];
		} else {
			throw new \Exception('"bootgrid-data" is missing in config!');
		}
	}
}
