<?php

class Hackathon_HealthCheck_Model_Check_Logfilesize extends Hackathon_HealthCheck_Model_Check_Abstract
{

    public function _run() {

        /** @var Hackathon_Healthcheck_Model_Content_Renderer_Abstract $renderer */
        $renderer = $this->getContentRenderer();

        $productCollection = Mage::getModel('catalog/product')->getCollection();
        $productCollection->getSelect()->group('type_id')->columns('type_id, COUNT(*) AS count');

        foreach ($productCollection as $_product) {
            $renderer->addValue($_product->getTypeId(), $_product->getCount());
        }

        return $this;
    }
}