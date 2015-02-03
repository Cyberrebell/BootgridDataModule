<?php

namespace BootgridDataModule\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use BootgridDataService\BootgridDataService;
use BootgridDataModule\Config\ConfigReader;

class BootgridDataController extends AbstractRestfulController
{
    function dataProviderAction() {
    	$result = ['success' => false];
    	
    	$entity = $this->params()->fromRoute('entity');
    	if (!$entity) {
    		$viewModel = new JsonModel($result);
    		return $viewModel;
    	}
    	
    	$configReader = new ConfigReader($this->getServiceLocator()->get('Config'));
    	$entityNamespace = $configReader->getEntityNamespace($entity);
    	
    	if ($this->getRequest()->isPost()) {
    		$service = new BootgridDataService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $entityNamespace);
			$service->setSearchableProperties($configReader->getSearchableProperties($entity));
    		$post = $this->getRequest()->getPost();
    		$result = $service->queryByPost($post);
    	}
    	
    	$viewModel = new JsonModel($result);
    	return $viewModel;
    }
}
