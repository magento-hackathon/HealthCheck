<?php

class Hackathon_HealthCheck_Model_Check_Logfilesize extends Hackathon_HealthCheck_Model_Check_Abstract
{
    /**
     * @param $bytes Size
     * @param int $decimals float
     * @return string Size
     *
     * Shamelessly stolen from php.net
     */
    private function human_filesize($bytes, $decimals = 2) {
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor));
    }

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
                    if ($file != "." && $file != ".." && strpos($file, '.log'))
                    {
                        $filesize = filesize($path . $file);
                        // Byte to MB conversion, round to two
                        /**
                         * @TODO dynamically choose KB, MB, BG and use it correct in frontend
                         */
                        $renderer->addValue($file, number_format($filesize/1024/1024, 2), 2);
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