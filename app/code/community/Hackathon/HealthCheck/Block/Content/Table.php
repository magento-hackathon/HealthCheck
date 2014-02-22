<?php

/**
 *
 * @method Hackathon_HealthCheck_Block_Content_Table setHeaderRow() set the header row for table
 *
 */

class Hackathon_HealthCheck_Block_Content_Table extends Hackathon_HealthCheck_Block_Content_Abstract
{

    /**
     *
     */
    public function _construct()
    {
        $this->init();
    }

    /**
     * Reset the table rows.
     */
    public function init()
    {
        $this->setRows(array());
        $this->setHeaderRow(array());

        return $this;
    }

    /**
     * Retrieve the data for the block output.
     *
     * @return mixed
     */
    public function _getBlockContent()
    {
        $result = array();
        foreach ($this->getRows() as $row) {
            $result[] = array_combine($this->getHeaderRow(), $row);
        }
        return $result;
    }

    /**
     * Add new row to table.
     *
     * @param $row
     * @return $this
     */
    public function addRow($row)
    {
        $rows = $this->getRows();
        $rows[] = $row;
        $this->setRows($rows);

        return $this;
    }

}