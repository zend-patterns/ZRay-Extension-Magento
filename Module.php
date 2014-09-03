<?php
namespace ZRay\Extension;
use DevBar\ModuleManager\Feature\DevBarProducerProviderInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements DevBarProducerProviderInterface, AutoloaderProviderInterface {
	
	public function getDevBarProducers(EventInterface $e) {
		return array();
	}
	
	/* (non-PHPdoc)
	 * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
	 */
	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
			    array(array(
			    	'ZRay\Extension\Producer\Magento' => 'ZRay\Extension\Producer\Magento.php'
			    ))
			)
		);
	}

}

