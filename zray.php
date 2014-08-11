<?php

$zre = new \ZRayExtension('magento');
$zre->traceFunction('Mage::run', function(){}, function($context, &$storage){
	echo __METHOD__;
	/// $eventArea?
	$storage['events'] = Mage::app()->getConfig()->getNode(sprintf('%s/events', $eventArea));
	$storage['info'] = array('store' => Mage::app()->getStore(), 'website' => Mage::app()->getWebsite(), 'frontcontroller' => Mage::app()->getFrontController(), 'request' => Mage::app()->getRequest());
	$storage['handles'] = Mage::app()->getLayout()->getUpdate()->getHandles();
});
