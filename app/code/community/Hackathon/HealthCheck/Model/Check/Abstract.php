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

        return $this->_checkVersions();
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
        $this->getContentRenderer()->renderResult();

        return $this;
    }

    /**
     * Actually perform the check and return the result
     *
     * @return mixed
     */
    abstract function _run();

    /**
     * @return bool
     */
    protected function _checkVersions()
    {
        if (!count($this->getVersions())) {
            return true;
        }

        $mageVersion = Mage::getVersion();

        /** @var Hackathon_HealthCheck_Helper_Data $helper */
        $helper = Mage::helper('hackathon_healthcheck');

        // retrieve supported versions from config.xml
        $versions = $helper->extractVersions($this->getVersions());

        // iterate on versions to find a fitting one
        foreach ($versions as $_version) {
            $quotedVersion = preg_quote($_version);

            // build regular expression with wildcard to check magento version
            $pregExpr = '#\A' . str_replace('\*', '.*', $quotedVersion) . '\z#ims';

            if (preg_match($pregExpr, $mageVersion)) {
                return true;
            }
        }
        return false;
    }
}