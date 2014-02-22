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


   	    $sitemaps = Mage::getModel('sitemap/sitemap')->getCollection();

	    $array = array();

	    foreach ($sitemaps as $sitemap) {
    	    	$filename = $sitemap->getSitemapFilename();
    		$time = $sitemap->getSitemapTime();
    		$id = $sitemap->getSitemapId();
    		$path = $sitemap->getSitemapPath();

		$total_path = Mage::getBaseDir() . $path . $filename;

    		if (file_exists($total_path)){
        	    $last_mod = filemtime($total_path);
        	    $last_change = date("d/m/Y H:i:s", $last_mod);

        	    $time24 = mktime(0,0,86400,0,0,0);

        	    if (time() >= $last_mod + $time24) {
            		$chng_time = "Did not changed past 24h";
        	    }
        	    else {
            		$chng_time =  "Okay";
        	    }

        	$array[] = array ($id,$filename,$total_path,$chng_time);
    		}
    		else {
        	    echo "File" . $total_path . "does not exist";
    		}
	    }

            return $array;
        } else {
            return array("result" => "false");
        }
    }
}
