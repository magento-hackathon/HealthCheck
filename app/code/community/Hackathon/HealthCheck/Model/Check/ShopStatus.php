<?php

class Hackathon_HealthCheck_Model_Check_ShopStatus extends Hackathon_HealthCheck_Model_Check_Abstract
{
    public function _run() {

        $helper = Mage::helper('hackathon_healthcheck');

        $renderer = $this->getContentRenderer();

        $header = array(
            $helper->__('Service'),
            $helper->__('Status'),
        );

        $row = array();

        /**
         * Webserver interface, PHP.ini information
         */
        $row[$helper->__("Webserver")] = $_SERVER["SERVER_SOFTWARE"];
        $row[$helper->__("Maximum execution time (PHP)")] = ini_get('max_execution_time');
        $row[$helper->__("Memory Limit")] = ini_get('memory_limit');

        /**
         * HTACCESS-Check
         */
        if (file_exists(Mage::getBaseDir() . "/.htaccess")) {
            $row[$helper->__('.htaccess')] = $helper->__('.htaccess exists');
        } else {
            $row[$helper->__('.htaccess')] = $helper->__('.htaccess does not exist');
        }

        /**
         * Magento-URL Information
         */
        $row[$helper->__('Admin-URL')] = Mage::getUrl().Mage::getConfig()->getNode('global/admin/routers/adminhtml/args/frontName');

        foreach (Mage::app()->getStores() as $store) {
            $row[$store->getName()] = Mage::app()->getStore($store->getId())->getUrl();
        }

        /**
         * Rendering
         */
        $renderer->setHeaderRow($header);

        foreach ($row as $key => $line ) {
            $renderer->addRow(array($key, $line));
        }




        return $this;
    }
}