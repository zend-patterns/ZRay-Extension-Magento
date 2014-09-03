<?php

namespace ZRayExtensionMagento;
use DevBar\ModuleManager\Feature\DevBarProducerProviderInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Loader\StandardAutoloader;
use ZRayExtensionMagento\Producer\Magento;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements DevBarProducerProviderInterface, AutoloaderProviderInterface, ConfigProviderInterface {
	
	public function getConfig() {
		return include 'config/module.config.php';
	}
	
	/* (non-PHPdoc)
	 * @see \DevBar\ModuleManager\Feature\DevBarProducerProviderInterface::getDevBarProducers()
	 */
	public function getDevBarProducers(EventInterface $e) {
		return array(new Magento());
	}
	
	/* (non-PHPdoc)
	 * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
	 */
	public function getAutoloaderConfig() {
		return array(
    			'Zend\Loader\StandardAutoloader' => array(
    					StandardAutoloader::LOAD_NS => array(
    							__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
    					),
    			),
    	);
	}

}

