<?php

class Hackathon_HealthCheck_Model_Factory extends Mage_Core_Model_Abstract
{

    /**
     * Retrieve a check model.
     *
     * @param $checkIdentifier
     * @return mixed
     */
    public function getCheck($checkIdentifier) {
        $checkConfig = Mage::getConfig()->getNode('global/healthcheck/'.$checkIdentifier);

        if ($checkConfig) {
            $model = Mage::getModel($checkConfig->model);
            $model->setData($checkConfig->asArray());
            return $model;
        } else {
            Mage::throwException('Check Identifier not found or not present!');
        }
    }

    /**
     * Return a content block of specified type.
     *
     * @param $check
     * @return mixed
     */
    public function getContentBlock($check)
    {
        $block = Mage::getSingleton('core/layout')->createBlock('hackathon_healthcheck/content_' . $check->getContentType());
        if ($block) {
            $block->setCheck($check);
            return $block;
        } else {
            Mage::throwException('Block Type not found: ' . $check->getContentType());
        }
    }
}