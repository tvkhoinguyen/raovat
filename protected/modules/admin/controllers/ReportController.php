<?php

class ReportController extends AdminController 
{

    public $pluralTitle = 'Report Sale Management';
    public $singleTitle = 'Report Sale';
    public $cannotDetele = array();

    //----------------------------------Report Sale----------------
    //K Nguyen
    protected function performAjaxValidation($model) 
    {
        if (isset($_POST['ajax'])) 
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionReportSale()
    {
            $model=new SpOrders();
            // $this->performAjaxValidation($model);
            $model->unsetAttributes();  
            if(isset($_GET['SpOrders']))
            {
                $model->attributes=$_GET['SpOrders'];
                $model->from_date = $_GET['SpOrders']['from_date'];
                $model->to_date = $_GET['SpOrders']['to_date'];
            }
            $this->render('reportSale',array(
                'model'=>$model, 
                'actions' => $this->listActionsCanAccess,
            ));
    }
    //----------------------------------Best Purchased Report - Export----------------
    //Knguyen
    public function actionBestPurchasedReport()
    {
            $model=new OrderDetails('searchBestPurchased');
            $model->unsetAttributes();  
            if(isset($_GET['OrderDetails']))
                $model->attributes=$_GET['OrderDetails'];

            $model->validate();
            $this->render('bestPurchasedReport', array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
    }
    public function actionViewBestPurchasedReport($id) 
    {
    }
    //----------------------------------Low Stock Report----------------
    //Knguyen
    public function actionLowStockReport()
    {
            $model=new ProductItems();
            $model->unsetAttributes();  
            if(isset($_GET['ProductItems']))
                $model->attributes=$_GET['ProductItems'];

            $this->render('lowStockReport',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
    }

    public function actionViewLowStock($id) 
    {
    }

    

    //Knguyen
    //view reportSale detail
    public function actionView($id) 
    {
        try {
            $model = $this->loadModel($id); //Orders
            $this->render('view', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->id            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
    
    //K Nguyen
    public function actionExport($type, $filename, $time=null) 
    {
        Yii::import('application.extensions.phpexcel.Classes.PHPExcel');
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()
                    ->setCreator("")
                    ->setLastModifiedBy("")
                    ->setTitle('Report')
                    ->setSubject("Office 2007 XLSX Document")
                    ->setDescription("Report")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("Report");
        $objPHPExcel->getActiveSheet()->setTitle('Report');
        $objPHPExcel->setActiveSheetIndex(0);
        //report sale
        if(!empty($type) && $type!='' && $type=='sale' )
        {
            $objPHPExcel = ReportComponent::reportSale($objPHPExcel);
        }

        // if(!empty($type) && $type=="lowStock" && $type!=""  )
        // {
        //     $objPHPExcel = ReportComponent::reportLowStock($objPHPExcel);
        // }

        // if(!empty($type) && $type=="bestPurchasedReport" && $type!=""  )
        // {
        //     $objPHPExcel = ReportComponent::bestPurchasedReport($objPHPExcel);
        // }

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        for ($level = ob_get_level(); $level > 0; --$level) 
        {
            @ob_end_clean();
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        Yii::app()->end();
    }


    //-------------------------Core function---------------------------
    //Not delete

    public function actionDelete($id) {
        try {
            if(Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                if (!in_array($id, $this->cannotDetele))
                {
                    if($model = $this->loadModel($id)){
                                                if($model->delete())
                            Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                    }

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                }
            } else {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }
        } catch (Exception $e) {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }      

    

    public function actionDeleteAll()
    {
        $deleteItems = $_POST['orders-grid_c0'];
        $shouldDelete = array_diff($deleteItems, $this->cannotDetele);

        if (!empty($shouldDelete))
        {
                        Orders::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
            $this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
        }
        else
            $this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

        
    public function loadModel($id){
        //need this define for inherit model case. Form will render parent model name in control if we don't have this line
        $initMode = new Orders();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    





    //-----------------------------------XUAN TINH-------------------------
    /**
     * @Author: Xuan Tinh Sep 30, 2014
     * @Todo: Manual Sale Report Daily
     * @Param: $report_type, $date_form, $date_to
     * @return: List report
     */
    public function actionManualSale()
    {
        $this->pluralTitle = "Manual Sale Report";
        $this->singleTitle = "Manual Sale Report";
        $search = new ReportManualForm('search');
        $search->type = "";
        // $search->date_from = "01/" . date('m/Y', time()); 
        // $search->date_to = date('d/m/Y', time());
        
        $dataProvider = array();
        if (isset($_POST['ReportManualForm'])) {
            $search->attributes =  $_POST['ReportManualForm'];
            if ($search->validate()) {
                $type = $search->type;
                if(!empty($search->date_from))
                    $date_form = DateHelper::toDbDateFormat($search->date_from);
                else
                    $date_form = NULL;

                if(!empty($search->date_to))
                    $date_to = DateHelper::toDbDateFormat($search->date_to); 
                else
                    $date_to=NULL;

                $search->validate();
                $rawData = $this->getDataReport($type, $date_form, $date_to);
                $dataProvider = new CArrayDataProvider($rawData, array(
                    'id' => 'report',
                    'sort'=>array(
                        'attributes'=>array(
                             'id', 'dateReport', 'totalSale', 'totalSellerCost', 'totalMarkup', 'totalShip'
                        ),
                    ),
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['defaultPageSize'],
                    ),
                ));
            }
        }
        
        $this->render('manual_sale_report', array(
            'dataProvider' => $dataProvider,
            'search' => $search,
        ));
    }
    
    public function getDataReport($type, $form=NULL, $to=NULL) 
    {
        $condition = "";
        if ($type == ReportManualForm::TYPE_DAILY) {
            $dateReport = " DATE(t.created_date) ";
            if(!empty($form) && !empty($to) )
                $condition = " AND DATE(t.created_date) BETWEEN '" . $form . "' AND '" . $to . "' Group By " . $dateReport;
            else
                $condition = " Group By " . $dateReport;
        } elseif ($type == ReportManualForm::TYPE_MONTHLY) {
            $dateReport = " DATE_FORMAT(t.created_date, '%Y-%m') ";
            if(!empty($form) && !empty($to) )
                $condition = " AND DATE_FORMAT(t.created_date, '%Y-%m') BETWEEN '" . date('Y-m', strtotime($form)) . "' AND '" . date('Y-m', strtotime($to)) . "' Group By " . $dateReport ;
            else
                $condition = " Group By " . $dateReport;

        } elseif ($type == ReportManualForm::TYPE_YEARLY) {
            $dateReport = " DATE_FORMAT(t.created_date, '%Y') ";
            if(!empty($form) && !empty($to) )
                $condition = " AND DATE_FORMAT(t.created_date, '%Y') BETWEEN '" . date('Y', strtotime($form)) . "' AND '" . date('Y', strtotime($to)) . "' Group By " . $dateReport;
            else
                $condition = " Group By " . $dateReport;
        }

        //total Markup = totalSell - totalCostSeller - GST - Ship;
        $sql = "SELECT id, sum(t.total_makup_price + t.total_shiping_fee + t.total_gst) as totalSale,
            (    sum(t.total_makup_price ) 
                - sum(t.total_price) 
            )
            as totalMarkup,
                sum(t.total_price) as totalSellerCost,
                sum(t.total_shiping_fee) as totalShip,
                " . $dateReport . " as dateReport 
                FROM `eog_eog_orders` as t 
                WHERE status =  " . ORDER_STATUS_SELLER_SHIPPED  . " AND is_completed = " . ORDER_COMPLETED . $condition;
        $rawData = Yii::app()->db->createCommand($sql)->queryAll();
        return $rawData;
    }


    /**
     * @Author: Xuan Tinh Sep 30, 2014
     * @Todo: Export Manual Sale Report
     * @Param: $report_type, $date_form, $date_to
     * @return: List report
     */
    public function actionExportManualSale() 
    {
        $type = $_GET['type'];
        $date_form = $_GET['from'];
        $date_to = $_GET['to'];
        $arrData = $this->getDataReport($type, $date_form, $date_to);
        Yii::import('application.extensions.phpexcel.Classes.PHPExcel');
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()
                ->setCreator("")
                ->setLastModifiedBy("")
                ->setTitle('Report')
                ->setSubject("Office 2007 XLSX Document")
                ->setDescription("Report")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Report");
        $objPHPExcel->getActiveSheet()->setTitle('Report Manual Sale');
        $objPHPExcel->setActiveSheetIndex(0);
        //report sale
        $objPHPExcel->getActiveSheet()->setCellValue("A1", 'Date', true);
        $objPHPExcel->getActiveSheet()->setCellValue("B1", 'Total Sale', true);
        $objPHPExcel->getActiveSheet()->setCellValue("C1", 'Total Seller Cost', true);
        $objPHPExcel->getActiveSheet()->setCellValue("D1", 'Total Markup', true);
        $objPHPExcel->getActiveSheet()->setCellValue("E1", 'Total Shiping Charge', true);
        
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setSize(13)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->getColor()->setRGB('000000');


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("B")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("C")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("D")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("E")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $index = 1;

        foreach ($arrData as $model) {
            $index++;
            $objPHPExcel->getActiveSheet()->setCellValue("A" . $index, Yii::app()->format->dateManualReport($model['dateReport']) , true);
            $objPHPExcel->getActiveSheet()->setCellValue("B" . $index, $model['totalSale'], true);
            $objPHPExcel->getActiveSheet()->setCellValue("C" . $index, $model['totalSellerCost'], true);
            $objPHPExcel->getActiveSheet()->setCellValue("D" . $index, $model['totalMarkup'], true);
            $objPHPExcel->getActiveSheet()->setCellValue("E" . $index, $model['totalShip'], true);


            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        }
        
        //save file
        //save file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Manual_Sale_' . date('Y-m-d', time()) . '.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

        Yii::app()->end();
    }

}
