<?php

class Hackathon_HealthCheck_Helper_Data extends Mage_Core_Helper_Abstract {

    const VERSIONS_REGEXP = '#[\d\.\*]+#ims';

    const CHECK_NODE = 'global/healthcheck/%s';

    const TYPE_STATIC = 'static';
    const TYPE_ONDEMAND = 'ondemand';

    const WARN_CSSCLASS = '_cssClasses';
    const WARN_TYPE_OK = 'health-ok';
    const WARN_TYPE_WARNING = 'health-warning';
    const WARN_TYPE_ERROR = 'health-error';

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

    public function getConst($typestring) {
        return constant('self::'.$typestring);
    }

}