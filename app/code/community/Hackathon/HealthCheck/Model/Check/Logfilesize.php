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
            $factory = Mage::getModel('hackathon_healthcheck/factory');
            $this->setContentType(Hackathon_HealthCheck_Block_Content_Plaintext::CONTENT_TYPE_PLAINTEXT);
            $block = $factory->getContentRenderer($this);
            $this->setBlock($block);
            $block->setContent($helper->__('No log directory'));
        }
        return $this;
    }
}