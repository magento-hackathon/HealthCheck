<?php

class Hackathon_HealthCheck_Model_Check_Logfilesize extends Hackathon_HealthCheck_Model_Check_Abstract
{

    public function _run() {

        /** @var Hackathon_Healthcheck_Model_Content_Renderer_Abstract $renderer */
        $renderer = $this->getContentRenderer();
        $path = Mage::getBaseDir() . '/var/log/';

        if(is_dir($path)) {
            if($handle = opendir($path)) {
                while (($file = readdir($handle)) !== false)
                    if ($file != "." && $file != "..") {
                        $renderer->addValue($file, 10);
                    }
                    closedir($handle);
            }
        }

        //$renderer->addValue('test', '2');

    }
}