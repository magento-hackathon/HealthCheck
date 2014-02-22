<?php
/**
 * @category Shopwerft
 * @package Shopwerft_XXX
 * @author Shopwerft GmbH <werft@shopwerft.com>
 * @author Benjamin Wunderlich <b.wunderlich@shopwerft.com>
 * @copyright 2013 Shopwerft GmbH (http://www.shopwerft.com)
 */

class Hackathon_HealthCheck_Model_Content_Renderer_Plaintext extends Hackathon_HealthCheck_Model_Content_Renderer_Abstract
{

    const CONTENT_TYPE_PLAINTEXT = 'plaintext';

    /**
     * Retrieve the data for the block output.
     *
     * @return string
     */
    public function _getContent()
    {
        if ($this->getContent()) {
            return $this->getContent();
        }
        /**
         * @todo create a better solution
         */
        return '';
    }


}