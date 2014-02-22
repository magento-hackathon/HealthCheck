<?php

class Hackathon_HealthCheck_CheckController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $factory = Mage::getModel('hackathon_healthcheck/factory');
        /**
         * Hardcoded for fun
         */
        $check = $factory::getCheck('sitemap');

        print_r($check);
    }
}
