<?php

/**
 *
 * @method Hackathon_HealthCheck_Model_Content_Renderer_Table setHeaderRow() set the header row for table
 *
 */

class Hackathon_HealthCheck_Model_Content_Renderer_Table extends Hackathon_HealthCheck_Model_Content_Renderer_Abstract
{

    const CONTENT_TYPE_TABLE = 'table';

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
    public function _getContent()
    {
        $result = array();
        foreach ($this->getRows() as $row) {
            $rowData = array_combine($this->getHeaderRow(), $row['values']);
            if (isset($row['config'])) {
                $rowData = array_merge($rowData, $row['config']);
            }
            $result[] = $rowData;
        }
        return $result;
    }

    /**
     * Add new row to table.
     *
     * @param $row
     * @param $rowConfig array()
     * @return $this
     */
    public function addRow($row, $rowConfig = array())
    {
        $rows = $this->getRows();

        // collect data for new row and combine with config
        $rowData = array('values' => $row);
        if (count($rowConfig)) {
            $rowData['config'] = $rowConfig;
        }

        $rows[] = $rowData;
        $this->setRows($rows);

        return $this;
    }

}