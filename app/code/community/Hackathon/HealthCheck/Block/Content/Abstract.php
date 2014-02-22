<?php

/**
 * @method string getContentType()
 * @method string setContentType($type)
 */

abstract class Hackathon_HealthCheck_Block_Content_Abstract extends Mage_Core_Block_Abstract
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
    public function getBlockContent()
    {
        $blockContent = $this->_getBlockContent();

        $result = array(
            'type'      => $this->getCheck()->getContentType(),
            'content'   => $blockContent
        );

        return $this->_encode($result);
    }

    /**
     *
     */
    public function renderResult()
    {
        echo $this->getBlockContent();
    }

    /**
     * Retrieve the data for the block output.
     *
     * @return string
     */
    abstract protected function _getBlockContent();

}