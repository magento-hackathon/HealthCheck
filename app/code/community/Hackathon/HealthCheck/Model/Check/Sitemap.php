<?php
/**
 * Created by PhpStorm.
 * User: blaber
 * Date: 22/02/14
 * Time: 11:47
 */

class Hackathon_HealthCheck_Model_Check_Sitemap extends Hackathon_HealthCheck_Model_Check_Abstract
{
    public function getType() {
        return 'static';
    }

    public function run() {
        return true;
    }
}