<?php

namespace Magento\Panels;

use DevBar\Listener\AbstractDevBarProducer;
use Zend\View\Model\ViewModel;

class Amit extends AbstractDevBarProducer {
	
	/* (non-PHPdoc)
	 * @see \DevBar\Listener\AbstractDevBarProducer::__invoke()
	 */
	public function __invoke() {
		$viewModel = new ViewModel();
		
		$viewModel->setVariable('params', array(
			'menuTitle' 	=> 'Amit1',
			'panelTitle'	=> 'Amit2',
		));
		
		$viewModel->setTemplate('amit');
		
		return $viewModel;
	}
}

