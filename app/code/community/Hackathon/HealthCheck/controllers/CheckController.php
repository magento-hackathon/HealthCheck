<?php

class Hackathon_HealthCheck_CheckController extends Mage_Adminhtml_Controller_Action
{
    public function __construct() {
        die('blergh');
    }

    public function indexAction()
    {
        $factory = Mage::getModel('hackathon_healthcheck/factory');
        /**
         * Hardcoded for fun
         */
        $check = $factory::getCheck('sitemap');

        print_r($check->getData());
    }
}