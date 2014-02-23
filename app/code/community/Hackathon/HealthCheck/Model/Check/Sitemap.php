<?php
/**
 * Created by PhpStorm.
 * User: blaber
 * Date: 22/02/14
 * Time: 11:47
 */

class Hackathon_HealthCheck_Model_Check_Sitemap extends Hackathon_HealthCheck_Model_Check_Abstract
{

    public function _run() {
   	    $sitemaps = Mage::getModel('sitemap/sitemap')->getCollection();

        $helper = Mage::helper('hackathon_healthcheck');

        if (count($sitemaps)) {

            $header = array(
                $helper->__('ID'),
                $helper->__('Filename'),
                $helper->__('Path'),
                $helper->__('Status')
            );
            $this->getContentRenderer()->setHeaderRow($header);

            foreach ($sitemaps as $sitemap) {
                $filename = $sitemap->getSitemapFilename();
                $id = $sitemap->getSitemapId();
                $path = $sitemap->getSitemapPath();

                $totalPath = Mage::getBaseDir() . $path . $filename;

                if (file_exists($totalPath)){
                    $last_mod = filemtime($totalPath);

                    $time24 = mktime(0,0,86400,0,0,0);

                    if (time() >= $last_mod + $time24) {
                        $status = $helper->__('OK, but not change within last 24h');
                        $warn = array('_cssClasses' => Hackathon_HealthCheck_Model_Check_Abstract::WARN_TYPE_WARNING);
                    } else {
                        $status = $helper->__('OK');
                        $warn = array('_cssClasses' => Hackathon_HealthCheck_Model_Check_Abstract::WARN_TYPE_OK);
                    }
                } else {
                    $status = $helper->__('Sitemap file not found');
                    $warn = array('_cssClasses' => Hackathon_HealthCheck_Model_Check_Abstract::WARN_TYPE_ERROR);
                }
                $row = array ($id, $filename, $totalPath, $status);

                $this->getContentRenderer()->addRow($row, $warn);
            }
        } else {

            $this->throwPlaintextContent('No Sitemap available or found.');
        }

        return $this;
    }
}