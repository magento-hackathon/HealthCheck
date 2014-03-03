<?php

class Hackathon_HealthCheck_Model_Check_ModuleVersion extends Hackathon_HealthCheck_Model_Check_Abstract
{
    public function _run()
    {
        $renderer = $this->getContentRenderer();
        $helper = Mage::helper('hackathon_healthcheck');

        $modules = Mage::getConfig()->getNode('modules');

        $header = array(
            $helper->__('Name'),
            $helper->__('Version'),
        );

        $renderer->setHeaderRow($header);

        $arr = array();

        foreach ($modules as $module) {
            foreach ($module as $key => $xml) {
                $version = (string)$xml->version;

                $row = array ($key, $version);
                $renderer->addRow($row);
            }

        }


        return $this;
    }
}