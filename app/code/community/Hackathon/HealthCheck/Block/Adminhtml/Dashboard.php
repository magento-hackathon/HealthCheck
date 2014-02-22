<?php

class Hackathon_HealthCheck_Block_Adminhtml_Dashboard extends Mage_Adminhtml_Block_Template
{
    public function getAllChecks() {
        return array('producttypes' => 'piechart', 'sitemap' => 'table');
    }
}