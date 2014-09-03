<?php
use DevBar\ModuleManager\Feature\DevBarProducerProviderInterface;
use Zend\EventManager\EventInterface;

class Module implements DevBarProducerProviderInterface {
	
	public function getDevBarProducers(EventInterface $e) {
		return array();
	}
}

