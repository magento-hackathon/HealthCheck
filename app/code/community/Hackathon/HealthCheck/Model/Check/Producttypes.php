<?php

class Hackathon_HealthCheck_Model_Check_Producttypes extends Hackathon_HealthCheck_Model_Check_Abstract
{

    public function _run() {

        /** @var Hackathon_HealthCheck_Block_Content_Piechart $block */
        $block = $this->getBlock();

        $block
            ->addValue('simple', 199)
            ->addValue('grouped', 9)
            ->addValue('bundle', 39)
            ->addValue('configurable', 13)
            ->addValue('downloadable', 99)
            ->addValue('virtual', 1)
        ;

        return $this;
    }
}