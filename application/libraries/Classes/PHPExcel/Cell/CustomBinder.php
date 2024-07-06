<?php
if (!defined('PHPEXCEL_ROOT')) {
    /**
     * @ignore
     */
    define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../../');
    require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
}

class PHPExcel_Cell_MyColumnValueBinder extends PHPExcel_Cell_DefaultValueBinder implements PHPExcel_Cell_IValueBinder
{
    protected $stringColumns = [];

    public function __construct(array $stringColumnList = []) {
        // Accept a list of columns that will always be set as strings
        $this->stringColumns = $stringColumnList;
    }

    public function bindValue(PHPExcel_Cell $cell, $value = null)
    {
        // If the cell is one of our columns to set as a string...
        if (in_array($cell->getColumn(), $this->stringColumns)) {
            // ... then we cast it to a string and explicitly set it as a string
            $cell->setValueExplicit((string) $value, PHPExcel_Cell_DataType::TYPE_STRING);
            echo "<pre>===="; print_r($cell);die;
            return true;
        }
        // Otherwise, use the default behaviour
        return parent::bindValue($cell, $value);
    }
}

// Instantiate our custom binder, with a list of columns, and tell PHPExcel to use it
PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_MyColumnValueBinder(['A', 'B', 'C', 'E', 'F','G','H','I','J','K','L']));
