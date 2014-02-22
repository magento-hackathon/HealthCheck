<?php

abstract class Hackathon_HealthCheck_Model_Check_Abstract extends Mage_Core_Model_Abstract
{
    public function initCheck() {
        if ($this->getAvailability())
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return mixed Tell the framework, wether this check is compatible with the current Magento version
     */
    public function getAvailability() {

        /*
         * @TODO: Check Magento Version against versions from config
         */

        foreach ($this->versions as $version) {
            if (version_compare(Mage::getVersion(), $version)) {
                return true;
            } else {
                return false;
            }
        }
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