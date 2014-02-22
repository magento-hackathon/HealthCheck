<?php

class Hackathon_HealthCheck_CheckController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        echo "We have to build some blocks and layout here.";
    }

    public function ajaxAction()
    {
        $data = Mage::app()->getRequest()->getPost('checkIdentifier');

        /** @var $data Debug-Stub */
        $data = 'sitemap';

        $factory = Mage::getModel('hackathon_healthcheck/factory');

        if ($data) {
            $check = $factory::getCheck($data);
            $result = $check->run();
        }

        echo json_encode($result);

    }
}
