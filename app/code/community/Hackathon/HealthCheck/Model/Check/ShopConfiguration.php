<?php

class Hackathon_HealthCheck_Model_Check_ShopConfiguration extends Hackathon_HealthCheck_Model_Check_Abstract
{

    protected function _getValues()
    {
        return Mage::getConfig()->getNode($this->getConfigNodePath() . '/values')->children();
    }

    public function _run() {
        /** @var Hackathon_HealthCheck_Helper_Data $helper */
        $helper = Mage::helper('hackathon_healthcheck');

        /** @var Hackathon_HealthCheck_Model_Content_Renderer_Table $renderer */
        $renderer = $this->getContentRenderer();

        $renderer->setHeaderRow(
            array(
                $helper->__('Configuration Parameter'),
                $helper->__('Configuration Path'),
                $helper->__('Configuration Value'),
                $helper->__('Configuration Recommendation')
            )
        );
        foreach ($this->_getValues() as $_valueName => $_config) {
            $rowConfig = array();
            $path = (string)$_config->path;
            $configValue =  Mage::getStoreConfig($path);

            if (is_null($configValue)) {
                $configValue = '---';
            }
            // get a more readable parameter name
            $paramName = (string) $_config->path;
            $beautyfulParamName = str_replace(
                array('/', '_'),
                array(' > ', ' '),
                $paramName
            );

            $recommendation = (string) $_config->recommendation;
            if ($recommendation) {
                if ($configValue == $recommendation) {
                    $rowConfig = array('_cssClasses'   => 'health-ok');
                } else {
                    $rowConfig = array('_cssClasses'   => 'health-warning');
                }
            } else {
                $recommendation = '---';
            }
            $renderer->addRow(
                array($beautyfulParamName, $paramName, $configValue, $recommendation),
                $rowConfig
            );
        }
        return $this;
    }
}