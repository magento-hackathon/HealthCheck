<?php
/**
 * Created by PhpStorm.
 * User: blaber
 * Date: 22/02/14
 * Time: 11:38
 */ 
class Hackathon_HealthCheck_Helper_Data extends Mage_Core_Helper_Abstract {

    const VERSIONS_REGEXP = '#[\d\.\*]+#ims';

    const CHECK_NODE = 'global/healthcheck/%s';

    /**
     * Extract versions from csv versions string with wildcards
     *
     * @param $versions
     * @return array matches
     */
    public function extractVersions($versions)
    {
        preg_match_all(self::VERSIONS_REGEXP, $versions, $matches);
        return $matches[0];
    }
}