<?php

abstract class Hackathon_HealthCheck_Model_Check_Abstract extends Mage_Core_Model_Abstract
{
    public function initCheck() {

        if ($this->getAvailability()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return mixed Tell the framework, wether this check is compatible with the current Magento version
     */
    public function getAvailability() {

        $result = true;

        if ($this->versions) {
            foreach ($this->versions as $version) {
                if (version_compare(Mage::getVersion(), $version, '=')) {
                    $result = true;
                } else {
                    $result = false;
                }
            }
        }

        return $result;
    }

    /**
     * Execute the check
     *
     * @return $this
     */
    public function run()
    {
        if ($this->initCheck()) {
            $this->_run();
        }
        $this->getBlock()->renderResult();

        return $this;
    }

    /**
     * Actually perform the check and return the result
     *
     * @return mixed
     */
    abstract function _run();
}