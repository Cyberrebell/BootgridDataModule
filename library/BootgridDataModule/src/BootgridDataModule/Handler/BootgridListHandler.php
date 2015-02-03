<?php

namespace BootgridDataModule\Handler;

use ZF2DoctrineCrudHandler\Handler\ListHandler;
use Zend\View\Model\ViewModel;

class BootgridListHandler extends ListHandler
{
    const DEFAULT_TEMPLATE = 'bootgrid/list.phtml';
    
    function getViewModel() {
    	if ($this->useCache) {
    		$viewModel = $this->recacheAgent->getViewModel('list', $this->entityNamespace, '');
    		if ($viewModel) {
    			return $viewModel;
    		}
    	}
    
    	$this->viewModel = new ViewModel();
    
    	$this->viewModel->setVariable('entityProperties', $this->getEntityProperties());
    
    	if ($this->listIcons === null) {
    		$this->listIcons = ['show' => '', 'edit' => '', 'delete' => ''];
    	}
    	$this->viewModel->setVariable('listIcons', $this->listIcons);
    	$this->viewModel->setVariable('listHeadIcons', $this->listHeadIcons);
    
    	$this->setupTemplate();
    	$this->setupTitle();
    
    	if ($this->useCache) {
    		$this->recacheAgent->storeViewModel($this->viewModel, 'list', $this->entityNamespace, '');
    	}
    
    	return $this->viewModel;
    }
}
