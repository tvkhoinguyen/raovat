<?php

/*
  # Author: Austin
  # Date: 18/10/2013
  # Version: 1.0
  # Description: this controller use for importing product, category, attributes, types
 */
class ExcelReader
{
    public $data = array();
    public $objPHPExcel = null;


    public function init()
    {
         
    }
    public function __construct($filePath, $sheetIndex = 0)
    {
        spl_autoload_unregister(array('YiiBase','autoload'));             
        Yii::import('application.extensions.phpexcel.Classes.PHPExcel', true);
        $this->objPHPExcel = PHPExcel_IOFactory::load($filePath);
        spl_autoload_register(array('YiiBase','autoload')); 
        
        if (file_exists($filePath))
        {
            try {
                $sheetData = $this->objPHPExcel->getSheet($sheetIndex)->toArray(null,true,true,true);
                $this->data = $sheetData;
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($filePath,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
        }
    }
    
}
?>
