<?php

/**
 * @method string getContentType()
 * @method string setContentType($type)
 */

abstract class Hackathon_HealthCheck_Model_Content_Renderer_Abstract extends Mage_Core_Model_Abstract
{

    /**
     * Encode the content to json.
     *
     * @param $content mixed
     * @return string
     */
    protected function _encode($content)
    {
        return Mage::helper('core')->jsonEncode($content);
    }

    /**
     * Return the encoded content.
     *
     * @return mixed
     */
    public function getContent()
    {
        $result = array(
            'type'      => $this->getCheck()->getContentType(),
            'content'   => $this->_getContent()
        );

        return $this->_encode($result);
    }

    /**
     *
     */
    public function renderResult()
    {
        echo $this->getContent();
    }

    /**
     * Retrieve the data for the json output.
     *
     * @return string
     */
    abstract protected function _getContent();

}