<?php

namespace BootgridDataModule\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use BootgridDataService\BootgridDataService;

class BootgridDataController extends AbstractRestfulController
{
    function dataProviderAction() {
    	$result = ['success' => false];
    	
    	$entity = $this->params()->fromRoute('entity');
    	if (!$entity) {
    		$viewModel = new JsonModel($result);
    		return $viewModel;
    	}
    	
    	$config = $this->getServiceLocator()->get('Config');
    	if (!array_key_exists('bootgrid-data', $config)) {
    		throw new \Exception('"bootgrid-data" is missing in config!');
    	}
    	
    	
    	if (!array_key_exists($entity, $config['bootgrid-data'])) {
    		throw new \Exception('entity "' . $entity . '" is not mapped in "bootgrid-data" config!');
    	}
    	$entityNamespace = $config['bootgrid-data'][$entity]['namespace'];
    	
    	if ($this->getRequest()->isPost()) {
    		$service = new BootgridDataService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $entityNamespace);
    		if (array_key_exists('searchable', $config['bootgrid-data'][$entity])) {
    			$service->setSearchableProperties($config['bootgrid-data'][$entity]['searchable']);
    		}
    		$post = $this->getRequest()->getPost();
    		$result = $service->queryByPost($post);
    	}
    	
    	$viewModel = new JsonModel($result);
    	return $viewModel;
    }
}
