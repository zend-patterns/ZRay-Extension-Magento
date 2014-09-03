<?php

namespace ZRayExtensionMagento\Producer;

use DevBar\Listener\AbstractDevBarProducer;
use Zend\View\Model\ViewModel;

class Magento extends AbstractDevBarProducer {
	
	/* (non-PHPdoc)
	 * @see \DevBar\Listener\AbstractDevBarProducer::__invoke()
	 */
	public function __invoke() {
		$viewModel = new ViewModel(array());
		$viewModel->setTemplate('z-ray/components/superglobals');
		return $viewModel;
	}

}

