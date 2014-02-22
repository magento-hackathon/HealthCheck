<?php

class Hackathon_HealthCheck_CheckController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function ajaxAction()
    {
        $checkIdentifier = $this->getRequest()->getParam('checkIdentifier');

        $factory = Mage::getModel('hackathon_healthcheck/factory');

        if ($checkIdentifier) {
            /** @var Hackathon_HealthCheck_Model_Abstract $check */
            $check = $factory->getCheck($checkIdentifier);

            /** @var Hackathon_HealthCheck_Model_Content_Renderer_Abstract $renderer */
            $renderer = $factory->getContentRenderer($check);
            $check
                ->setContentRenderer($renderer)
                ->run()
            ;
        }
    }
}
