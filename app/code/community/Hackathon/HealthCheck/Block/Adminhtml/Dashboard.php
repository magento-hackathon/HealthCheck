<?php

class Hackathon_HealthCheck_Block_Adminhtml_Dashboard extends Mage_Adminhtml_Block_Template
{
    public function getAllChecks()
    {
        /** @var Hackathon_HealthCheck_Model_Check_Collection $collection */
        $collection = Mage::getModel('hackathon_healthcheck/check_collection');

        return $collection;
    }

    public function getCheckBlock(Hackathon_HealthCheck_Model_Check_Abstract $check)
    {
        $block = $this->getLayout()->createBlock('healthcheck/adminhtml_type_' . $check->getType());
        $block->setCheck($check);
        return $block;
    }
}