<?php

class Hackathon_HealthCheck_Model_Check_Hiddenactivations extends Hackathon_HealthCheck_Model_Check_Abstract
{
    public function _run() {

        $renderer = $this->getContentRenderer();

        $renderer->addRow(array('testets', 'asdasd', '12312312'));

        return $this;
    }
}