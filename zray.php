<?php

class Magento {
	public function mageRunExit($context, &$storage){
		$storage['observers'] = array();
		$this->storeObservers($storage['observers']);
		$storage['info'] = array('store' => Mage::app()->getStore(), 'website' => Mage::app()->getWebsite(), 'frontcontroller' => Mage::app()->getFrontController(), 'request' => Mage::app()->getRequest());
		$storage['handles'] = Mage::app()->getLayout()->getUpdate()->getHandles();
	}
	
	public function appCallObserverMethod($context, & $storage){

		$method = $context['functionArgs'][1];
		$observerData = $context['functionArgs'][2]->getData();
		$event = $observerData['event']->getName();
		$object = get_class($context['functionArgs'][0]);

		$storage['events'] = array('event' => $event, 'class' => $object, 'method' => $method);
	}
	
	/**
	 * @param array $storage
	 */
	private function storeObservers(& $storage) {
		foreach (array('global', 'adminhtml', 'frontend') as $eventArea) {
			$eventConfig = $this->getEventAreaEventConfigs($eventArea);
			if (! ($eventConfig instanceof Mage_Core_Model_Config_Element)) {
				continue;
			}
			
			$events = $eventConfig->children();
			$this->processEventObservers($events, $eventArea, $storage);
		}
	}
	
	/**
	 * @param string $eventArea
	 * @return Mage_Core_Model_Config_Element|null
	 */
	private function getEventAreaEventConfigs($eventArea) {
		return Mage::app()->getConfig()->getNode(sprintf('%s/events', $eventArea));
	}
	
	private function processEventObservers($areaEvents, $eventArea, & $storage) {
		foreach ($areaEvents as $eventName => $event) {
			foreach ($event->observers->children() as $observerName => $observer) {
				$observerData = array(
						'area' => $eventArea,
						'event' => $eventName,
						'name' => $observerName,
						'class' => Mage::app()->getConfig()->getModelClassName($observer->class),
						'method' => (string)$observer->method
				);
				$storage[] = $observerData;
			}
		}
	}
}


$zrayMagento = new Magento();

$zre = new ZRayExtension('magento');
$zre->traceFunction('Mage::run', function(){}, array($zrayMagento, 'mageRunExit'));
$zre->traceFunction('Mage_Core_Model_App::_callObserverMethod', function(){}, array($zrayMagento, 'appCallObserverMethod'));
