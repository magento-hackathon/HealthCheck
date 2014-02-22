<?php

abstract class Hackathon_Healthcheck_Model_Check_Abstract extends Mage_Core_Model_Abstract
{

    /**
     * @return mixed Tell the framework, wether this check is compatible with the current Magento version
     */
    public function getAvailability($identifier) {

        /*
         * If magento version >= 1.7.0.0
         */
        return true;
    }

    /**
     * @return mixed Tell the framework, wether this check should be executed every time or just ondemand
     */
    abstract function getType();

    /**
     * @return mixed Actually perform the check and return the result
     */
    abstract function run();
}