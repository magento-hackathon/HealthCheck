<?php


class Hackathon_HealthCheck_Block_Content_Chart extends Hackathon_HealthCheck_Block_Content_Abstract
{

    const CONTENT_TYPE_PLAINTEXT = 'chart';


    /**
     * Retrieve the data for the block output.
     *
     * @return mixed
     */
    public function _getBlockContent()
    {
        return $this->getValues();
    }

    /**
     * Add new slice to pie chart.
     *
     * @param $title
     * @param $value
     * @return $this
     */
    public function addValue($title, $value)
    {
        if (is_null($this->getValues())) {
            $this->setValues(array());
        }

        $values = $this->getValues();
        $values[$title] = $value;
        $this->setValues($values);

        return $this;
    }

}