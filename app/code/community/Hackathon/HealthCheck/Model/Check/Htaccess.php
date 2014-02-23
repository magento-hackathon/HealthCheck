<?php

class Hackathon_HealthCheck_Model_Check_Htaccess extends Hackathon_HealthCheck_Model_Check_Abstract
{
    public function _run() {

        $helper = Mage::helper('hackathon_healthcheck');

        $renderer = $this->getContentRenderer();

        $renderer->setPlaintextContent(php_sapi_name());

        return $this;
    }
}