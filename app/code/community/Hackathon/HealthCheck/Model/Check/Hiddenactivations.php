<?php

class Hackathon_HealthCheck_Model_Check_Hiddenactivations extends Hackathon_HealthCheck_Model_Check_Abstract
{
    public function _run() {

        $helper = Mage::helper('hackathon_healthcheck');

        $renderer = $this->getContentRenderer();

        $renderer->setHeaderRow(array(
            $helper->__('XML File'),
            $helper->__('"active" Flags'),
            $helper->__('Status'))
        );



        $renderer->addRow(array('testets', 'asdasd', '12312312'));

        return $this;
    }
}