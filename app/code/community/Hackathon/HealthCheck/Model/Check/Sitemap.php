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
        return $this->display_type;
    }


    public function run() {
        if ($this->initCheck()) {
            /**
             * @TODO Do the actual check here
             */
            return array('result' => 'true');
        } else {
            return array('result' => 'false');
        }
    }
}