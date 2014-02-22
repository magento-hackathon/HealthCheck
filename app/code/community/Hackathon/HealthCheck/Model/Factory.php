<?php

class Hackathon_HealthCheck_Model_Factory
{
    static function getCheck($checkIdentifier) {
        $checkConfig = Mage::getConfig()->getNode('global/healthcheck/'.$checkIdentifier);

        if ($checkConfig) {
            $model = Mage::getModel($checkConfig->model);
            $model->setData($checkConfig->asArray());
            return $model;
        } else {
            Mage::throwException('Check Identifier not found or not present!');
        }


    }
}