<?php
class ReportComponent
{
    public static function reportSale($objPHPExcel)
    {
        //# Date (dd/mm/yyyy)   Order No    Client Name  Sub Total ($)   Delivery Fee ($)    GST ($) Total ($)   Order Status
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->getActiveSheet()->setCellValue("A1", 'Speed Printz Pte. Ltd', true);

        $objPHPExcel->getActiveSheet()->setCellValue("A2", 'Sales Report', true);
        $objPHPExcel->getActiveSheet()->setCellValue("A3", 'Report Generated on:', true);
        $objPHPExcel->getActiveSheet()->setCellValue("B3", date('d-m-Y'), true);

        $objPHPExcel->getActiveSheet()->setCellValue("A4", 'Date from:', true);
        $objPHPExcel->getActiveSheet()->setCellValue("B4", Yii::app()->session['from_date'], true);
        $objPHPExcel->getActiveSheet()->setCellValue("C4", 'Date to:', true);
        $objPHPExcel->getActiveSheet()->setCellValue("D4", Yii::app()->session['to_date'], true);


        $objPHPExcel->getActiveSheet()->setCellValue("A6", 'S/N', true);
        $objPHPExcel->getActiveSheet()->setCellValue("B6", 'Order Date', true);
        $objPHPExcel->getActiveSheet()->setCellValue("C6", 'Order No', true);
        $objPHPExcel->getActiveSheet()->setCellValue("D6", 'Client Name', true);
        $objPHPExcel->getActiveSheet()->setCellValue("E6", 'Sub Total ($)', true);
        $objPHPExcel->getActiveSheet()->setCellValue("F6", 'Delivery Fee ($)', true);
        $objPHPExcel->getActiveSheet()->setCellValue("G6", 'GST ($)', true);
        $objPHPExcel->getActiveSheet()->setCellValue("H6", 'Total ($)', true);
        $objPHPExcel->getActiveSheet()->setCellValue("I6", 'Order Status', true);
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFont()->setSize(13)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFont()->getColor()->setRGB('000000');


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle("B")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle("C")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle("D")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle("E")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("F")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("G")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("H")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("I")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


        $objPHPExcel->getActiveSheet()->getStyle("A6:I6")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $styleArray2 = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),));
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($styleArray2);

        $models = Yii::app()->session['reportSale'];

        $index = 7;
        if(!empty($models))
        {
            foreach ($models as $one) 
            {
                if( empty($one) ) continue;
                $objPHPExcel->getActiveSheet()->setCellValue("A" . $index, $index-5 , true);
                $objPHPExcel->getActiveSheet()->setCellValue("B" . $index, Yii::app()->format->date($one->created_date) , true);
                $objPHPExcel->getActiveSheet()->setCellValue("C" . $index, $one->order_no , true);
                $objPHPExcel->getActiveSheet()->setCellValue("D" . $index, $one->user_name , true);
                $objPHPExcel->getActiveSheet()->setCellValue("E" . $index, $one->sub_total, true);
                $objPHPExcel->getActiveSheet()->setCellValue("F" . $index, $one->shipping_fee , true);
                $objPHPExcel->getActiveSheet()->setCellValue("G" . $index, $one->gst , true);
                $objPHPExcel->getActiveSheet()->setCellValue("H" . $index, $one->total , true);
                $objPHPExcel->getActiveSheet()->setCellValue("I" . $index, SpOrders::getStatusOrder($one), true);
                $index++;

                
            }
        }

        //format size cho tung Column
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->getStyle('A6:I'.($index-1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A6:I'.($index-1))->applyFromArray($styleArray2);
        // $styleArray2 = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),));
        // $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        // $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray2);

        // $styleArray = array(
        //       'borders' => array(
        //             'right' => array(
        //                 'style' => PHPExcel_Style_Border::BORDER_THIN,
        //                 'color' => array(
        //                     'argb' => '000000',
        //                 ),
        //             ),
        //             'left' => array(
        //                 'style' => PHPExcel_Style_Border::BORDER_THIN,
        //                 'color' => array(
        //                     'argb' => '000000',
        //                 ),
        //             ),
        //       )
        // );

        // $styleBottom = array(
        //       'borders' => array(
        //             'bottom' => array(
        //                 'style' => PHPExcel_Style_Border::BORDER_THIN,
        //                 'color' => array(
        //                     'argb' => '000000',
        //                 ),
        //             )
        //       )
        // );
        // $objPHPExcel->getActiveSheet()->getStyle('A1:I'.($index-1))->applyFromArray($styleArray, false);
        // $objPHPExcel->getActiveSheet()->getStyle('A'.($index-1).':I'.($index-1))->applyFromArray($styleBottom, false);
        return $objPHPExcel;
    }    
}
