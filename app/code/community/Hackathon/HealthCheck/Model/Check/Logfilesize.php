<?php

class Hackathon_HealthCheck_Model_Check_Logfilesize extends Hackathon_HealthCheck_Model_Check_Abstract
{

    public function _run() {

        /** @var Hackathon_Healthcheck_Model_Content_Renderer_Abstract $renderer */
        $renderer = $this->getContentRenderer();
        $helper = Mage::helper('hackathon_healthcheck');

        $path = Mage::getBaseDir() . '/var/log/';

        if(is_dir($path) && file_exists($path))
        {
            if($handle = opendir($path))
            {
                while (($file = readdir($handle)) !== false)
                    if ($file != "." && $file != "..")
                    {
                        $filesize = filesize($path . $file) / 1024;
                        $renderer->addValue($file, number_format($filesize, 2));
                    }
                closedir($handle);
            }
        }
        else
        {
            $this->throwPlaintextContent('No log directory');
        }
        return $this;
    }
}