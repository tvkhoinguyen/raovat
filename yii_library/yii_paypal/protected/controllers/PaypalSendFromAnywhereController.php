<?php
class PaypalSendFromAnywhereController extends Controller {
    /**
     * @copyright (c) 2014, bb
     */
    public function actionPurchase() 
    {
        //step1
        //step2
        //step...
        //proceed to payment
        $aPackages = SrPackages::getPackagesInCart($aCartId);
        $totalAmount = 0;
        $aItems = array();
        foreach ($aPackages as $mPackage) {
            $aItems[] = array('item_name' => $mPackage->getPackageTitle(),
                'amount' => $mPackage->price,
                'quantity' => 1,
                'item_number' => $mPackage->id,
            );
            $totalAmount += $mPackage->price;
        }

        //ORDER PACKAGE
        $mOrder = new SrPackagesOrder();
        $mOrder->amount = $totalAmount;
        $mOrder->quantity = count($aPackages);
        $mOrder->status = PAYMENT_STATUS_PENDING;
        $mOrder->created_date = date('Y-m-d H:i:s');
        $mOrder->paypal_receiver_email = Yii::app()->params['paypal_email_address'];//NEED - same as param that was sent to paypal
        $mOrder->paypal_mc_currency = Yii::app()->params['paypal_currency'];//NEED - same as param that was sent to paypal
        $mOrder->save();

        /**
         * all $return_url in project:
         *      1. must be the same - in case of AUTO RETURN FROM PAYPAL only allow one url
         *      2. must be public ..in webroot/protected/controllers - in case of check access in member module ...may be prevent NOTIFY from paypal
         * 
         * payment_type - need this param in case of website have many types of purchase
         */
        $return_url = Yii::app()->createAbsoluteUrl('paypal/return', array('order_id' => $mOrder->id, 'payment_type'=>'buyPackageOrByProductOrAnythingelse'));
        $cancel_url = Yii::app()->createAbsoluteUrl('paypal/cancel', array('order_id' => $mOrder->id, 'payment_type'=>'buyPackageOrByProductOrAnythingelse'));
        $notify_url = Yii::app()->createAbsoluteUrl('paypal/notify', array('order_id' => $mOrder->id, 'payment_type'=>'buyPackageOrByProductOrAnythingelse'));
        Paypal::send($aItems, $return_url, $cancel_url, $notify_url, array('order_id' => $mOrder->id, 'payment_type'=>'buyPackageOrByProductOrAnythingelse'));
        
    }

}