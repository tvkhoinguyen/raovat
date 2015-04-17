<?php
/**
 * @copyright (c) 2014, bb
 */
class PaypalController extends Controller {    
   //bb
    public function actionNotify()
    {   
        if (Paypal::isValid()) //check valid post from paypal
        {            
            $payment_type = $_GET['payment_type'];
            $order_id = $_GET['order_id'];
            
            if($payment_type == 'buyPackage')
            {
                $mOrder = SrPackagesOrder::model()->findByPk($order_id);
                if ($mOrder) 
                {
                    if($mOrder->status != PAYMENT_STATUS_PAID)
                    {
                        $mOrder->paypal_status = $_POST['payment_status'];
                        $mOrder->post_json_from_paypal = json_encode($_POST);
                        $mOrder->update(array('paypal_status','post_json_from_paypal'));

                        $hasErrors = false;

                        // Check payment status 
                        if ($_POST['payment_status'] != 'Completed') 
                            $hasErrors = true;

                        // Check seller e-mail
                        if ($_POST['receiver_email'] != $mOrder->paypal_receiver_email)
                            $hasErrors = true;

                        // Compare the amount received on PayPal with the price you charged for the product or package
                        if ($_POST['mc_gross'] != $mOrder->amount) 
                            $hasErrors = true;

                        // Check the currency code
                        if ($_POST['mc_currency'] != $mOrder->paypal_mc_currency)
                            $hasErrors = true;

                        if($hasErrors == false)//SUCCESS
                        {
                            $mOrder->status = PAYMENT_STATUS_PAID;
                            $mOrder->payment_date = date('Y-m-d H:i:s');
                            $mOrder->paypal_transaction_id = $_POST['txn_id'];                        
                            $mOrder->update(array('status','payment_date','paypal_transaction_id'));

                            SendEmail::purchasedPackageSuccess($mOrder);//always send email if payment is successful
                        }
                        else
                        {
                            //send email or save log or nothing
                        }

                    }
                }
            }
            elseif($_GET['payment_type'] == 'buyProductOrAnythingelse')
            {
                //code here..
            }
        }
    }
    
    //bb
    public function actionReturn() 
    {
        $this->pageTitle = 'Successful Payment '. Yii::app()->params['title'] ;
        try 
        {
            if($_GET['payment_type'] == 'buyPackage')
            {
                //just for test on localhost - If you use firefox, after click "return" then you must "click here" and accept ASAP to get $_POST from Paypal correctly.
                if(isset($_POST['payment_status']))
                    $this->actionNotify();

                if (isset(Yii::app()->session['cart']))
                    unset(Yii::app()->session['cart']);

                $mOrder = SrPackagesOrder::model()->findByPk($_GET['order_id']);           
                $this->render('paypalReturn', array('mOrder' => $mOrder));
            }
            elseif($_GET['payment_type'] == 'buyProductOrAnythingelse')
            {
                //code here..
            }
        } 
        catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
        }
    }
    
    //bb
    public function actionCancel() 
    {
        $this->pageTitle = 'Cancelled Payment '. Yii::app()->params['title'] ;

        if (isset(Yii::app()->session['cart']))
            unset(Yii::app()->session['cart']);
        
        $this->render('paypalCancel');
    }
    
}