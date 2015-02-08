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
	protected $configReader;
	protected $entity;
	
	function listAction() {
		$handler = new BootgridListHandler($this->getServiceLocator(), $this->getObjectManager(), $this->getEntityNamespace());
		$handler->setPropertyBlacklist($this->getPropertyBlacklist());
		return $handler->getViewModel();
	}
	
	function showAction() {
		$handler = new ShowHandler($this->getServiceLocator(), $this->getObjectManager(), $this->getEntityNamespace());
		$handler->setEntityId($this->params('id', false));
		return $handler->getViewModel();
	}
	
	function addAction() {
		$handler = new AddHandler($this->getServiceLocator(), $this->getObjectManager(), $this->getEntityNamespace());
		$handler->setRequest($this->getRequest());
		$handler->setSuccessRedirect($this->redirect(), 'bootgrid', ['entity' => $this->params('entity', false), 'action' => 'list']);
		$handler->setPropertyBlacklist($this->getPropertyBlacklist());
		return $handler->getViewModel();
	}
	
	function editAction() {
		$handler = new EditHandler($this->getServiceLocator(), $this->getObjectManager(), $this->getEntityNamespace());
		$handler->setEntityId($this->params('id', false));
		$handler->setRequest($this->getRequest());
		$handler->setSuccessRedirect($this->redirect(), 'bootgrid', ['entity' => $this->params('entity', false), 'action' => 'list']);
		$handler->setPropertyBlacklist($this->getPropertyBlacklist());
		return $handler->getViewModel();
	}
	
	function deleteAction() {
		$handler = new DeleteHandler($this->getServiceLocator(), $this->getObjectManager(), $this->getEntityNamespace());
		$handler->setEntityId($this->params()->fromRoute('id', false));
		$handler->setSuccessRedirect($this->redirect(), 'bootgrid', ['entity' => $this->params('entity', false), 'action' => 'list']);
		return $handler->getViewModel();
	}
	
	protected function getEntityNamespace() {
		$this->configReader = new ConfigReader($this->getServiceLocator()->get('Config'));
		return $this->configReader->getEntityNamespace($this->getEntity());
	}
	
	protected function getPropertyBlacklist() {
		$this->configReader = new ConfigReader($this->getServiceLocator()->get('Config'));
		return $this->configReader->getPropertyBlacklist($this->getEntity());
	}
	
	protected function getEntity() {
		if (!$this->entity) {
			$this->entity = $this->params()->fromRoute('entity');
			if (!$this->entity) {
				$this->redirect()->toRoute('/');
				return false;
			}
		}
		return $this->entity;
	}
	
	protected function getObjectManager() {
		return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	}
}
