<?php

class Hackathon_HealthCheck_Model_Check_Producttypes extends Hackathon_HealthCheck_Model_Check_Abstract
{

    public function _run() {

        /** @var Hackathon_HealthCheck_Block_Content_Piechart $block */
        $block = $this->getBlock();

        $productCollection = Mage::getModel('catalog/product')->getCollection();
        $productCollection->getSelect()->group('type_id')->columns('type_id, COUNT(*) AS count');

        foreach ($productCollection as $_product) {
            $block->addValue($_product->getTypeId(), $_product->getCount());
        }

        return $this;
    }
}