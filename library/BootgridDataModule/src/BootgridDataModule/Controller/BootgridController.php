<?php

namespace BootgridDataModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZF2DoctrineCrudHandler\Handler\ShowHandler;
use BootgridDataModule\Config\ConfigReader;
use BootgridDataModule\Handler\BootgridListHandler;
use ZF2DoctrineCrudHandler\Handler\AddHandler;
use ZF2DoctrineCrudHandler\Handler\EditHandler;
use ZF2DoctrineCrudHandler\Handler\DeleteHandler;

class BootgridController extends AbstractActionController
{
	function listAction() {
		$handler = new BootgridListHandler($this->getServiceLocator(), $this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $this->getEntityNamespace());
		return $handler->getViewModel();
	}
	
	function showAction() {
		$handler = new ShowHandler($this->getServiceLocator(), $this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $this->getEntityNamespace());
		$handler->setEntityId($this->params('id', false));
		return $handler->getViewModel();
	}
	
	function addAction() {
		$handler = new AddHandler($this->getServiceLocator(), $this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $this->getEntityNamespace());
		$handler->setRequest($this->getRequest());
		$handler->setSuccessRedirect($this->redirect(), 'list');
		return $handler->getViewModel();
	}
	
	function editAction() {
		$handler = new EditHandler($this->getServiceLocator(), $this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $this->getEntityNamespace());
		$handler->setEntityId($this->params('id', false));
		$handler->setRequest($this->getRequest());
		$handler->setSuccessRedirect($this->redirect(), 'list');
		return $handler->getViewModel();
	}
	
	function deleteAction() {
		$handler = new DeleteHandler($this->getServiceLocator(), $this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $this->getEntityNamespace());
		$handler->setEntityId($this->params()->fromRoute('id', false));
		$handler->setSuccessRedirect($this->redirect(), 'list');
		return $handler->getViewModel();
	}
	
	protected function getEntityNamespace () {
		$entity = $this->params()->fromRoute('entity');
		if (!$entity) {
			$this->redirect()->toRoute('/');
		}
		$configReader = new ConfigReader($this->getServiceLocator()->get('Config'));
		return $configReader->getEntityNamespace($entity);
	}
}
