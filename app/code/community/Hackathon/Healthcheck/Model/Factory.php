<?php

class Hackathon_Healthcheck_Model_Factory
{
    static function getCheck($checkIdentifier) {
        $checkConfig = Mage::getConfig()->getNode('healthcheck/'.$checkIdentifier);

        if ($checkConfig) {
            $model = Mage::getModel($checkConfig['model']);
            $model->setData($checkConfig);
            return $model;
        } else {
            Mage::throwException('Check Identifier not found or not present!');
        }


    }
}