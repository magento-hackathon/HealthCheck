<?php
/**
 * Created by PhpStorm.
 * User: blaber
 * Date: 22/02/14
 * Time: 11:47
 */

class Hackathon_HealthCheck_Model_Check_Sitemap extends Hackathon_HealthCheck_Model_Check_Abstract
{

    private function getFileInfo($pathToFile, $mtime, $helper) {

        if (file_exists($pathToFile)){

            $date = Mage::getModel('core/date')->timestamp(time());
            $date = date('Y-m-d H:i:s', $date);
            $time24 = strtotime($date) - 86400;


            if ( $mtime - $time24 < 0) {
                $status = $helper->__('OK, but not change within last 24h');
                $warn = array('_cssClasses' => $helper->getConst('WARN_TYPE_WARNING'));
            } else {
                $status = $helper->__('OK');
                $warn = array('_cssClasses' =>  $helper->getConst('WARN_TYPE_OK'));
            }
            $lastModified = date('d.m.Y H:i:s ', $mtime);
        } else {
            $status = $helper->__('Sitemap file not found');
            $warn = array('_cssClasses' =>  $helper->getConst('WARN_TYPE_ERROR'));
            $lastModified = $helper->__('Not available');
        }

        return array($status, $warn, $lastModified);

    }

    public function _run() {
   	    $sitemaps = Mage::getModel('sitemap/sitemap')->getCollection();
        $helper = Mage::helper('hackathon_healthcheck');
        $renderer = $this->getContentRenderer();

        if (count($sitemaps)) {

            $header = array(
                $helper->__('Filename'),
                $helper->__('Path'),
                $helper->__('Status'),
                $helper->__('Last modified'),
            );
            $this->getContentRenderer()->setHeaderRow($header);

            foreach ($sitemaps as $sitemap) {
                $filename = $sitemap->getSitemapFilename();
                $path = $sitemap->getSitemapPath();
                $sitemapTime = strtotime($sitemap->getSitemapTime());
                $totalPath = Mage::getBaseDir() . $path . $filename;

                $fileInfo = $this->getFileInfo($totalPath, $sitemapTime, $helper);
                $row = array ($filename, $totalPath, $fileInfo[0], $fileInfo[2]);

                $renderer->addRow($row, $fileInfo[1]);
            }
        } else {

            $this->throwPlaintextContent('No Sitemap available or found.');
        }

        /**
         * Check for robots.txt as well. We do this here, because the
         * robots.txt info is the same as the sitemap-info - no filesize or bar-chart
         * needed. And its too little to do an own check for it.
         */

        $file = 'robots.txt';
        $path = Mage::getBaseDir() . '/' . $file;
        $mtime = filemtime($path);

        $fileInfo = $this->getFileInfo($path, $mtime, $helper);

        $renderer->addRow(array($file, $path, $fileInfo[0], $fileInfo[2]), $fileInfo[1]);

        return $this;
    }
}