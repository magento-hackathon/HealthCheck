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
        $blockString = 'hackathon_healthcheck/adminhtml_type_' . $check->getContentType();
        $block = $this->getLayout()->createBlock($blockString);
        $block
            ->setCheck($check)
            ->setTemplate('hackathon/healthcheck/type/default.phtml')
            //->setTemplate('hackathon/healthcheck/type/' . $check->getContentType() . '.phtml')
        ;
        return $block;
    }
}