<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use DoctrineEntityReader\EntityReader;
use DoctrineEntityFormGenerator\FormGenerator;
use BootgridDataService\BootgridDataService;

class BootgridDataController extends AbstractRestfulController
{
    function dataProviderAction() {
    	$result = ['success' => false];
    	if ($this->getRequest()->isPost()) {
    		$service = new BootgridDataService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), 'User\Entity\User');
    		$service->setSearchableProperties(['username', 'email']);
    		$post = $this->getRequest()->getPost();
    		$result = $service->queryByPost($post);
    	}
    	
    	$viewModel = new JsonModel($result);
    	return $viewModel;
    }
}
