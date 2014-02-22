<?php

class Hackathon_HealthCheck_Model_Check_Collection extends Varien_Data_Collection
{
    public function loadData($printQuery = false, $logQuery = false)
    {
        $nodeString = trim(sprintf(Hackathon_HealthCheck_Helper_Data::CHECK_NODE, ''), '/');
        $checkConfig = Mage::getConfig()->getNode($nodeString);

        /** @var Hackathon_HealthCheck_Model_Factory $factory */
        $factory = Mage::getModel('hackathon_healthcheck/factory');
        foreach ($checkConfig->asArray() as $key => $_checkConfig) {
            $check = $factory->getCheck($key);
            $this->_addItem($check);
        }

        return $this;
    }


}