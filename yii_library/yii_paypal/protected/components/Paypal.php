<?php
/**
 * @copyright (c) 2014, bb
 */
class Paypal
{
       /**
        * @example 1:
          $aItems = array( 0 => array(
                                      'item_name' => 'name',
                                      'amount' => '99',
                                      'quantity' => 1,
                                      'item_number' => 'item_id',
                                      ),
                          1 => array(
                                      'item_name' => 'name',
                                      'amount' => '99',
                                      'quantity' => 1,
                                      'item_number' => 'item_id',
                                      ),
                );

        * @example 2:
          $aItems = array();
            $aItems[] = array( 'item_name' => 'name',
                                              'amount' => '99',
                                              'quantity' => 1,
                                              'item_number' => 'item_id',
                                            );
        *
        */
    public static function send($aItems, $return_url, $cancel_url, $notify_url)
    {
        
        $paypal_email = Yii::app()->params['paypal_email_address']; //bussiness email
        $paypal_type = Yii::app()->params['paypalType'];//live or test

        $querystring = "?business=".urlencode($paypal_email)."&";
        $querystring .= "cmd=".urlencode("_cart")."&";
        $querystring .= "upload=".urlencode(1)."&";
        $querystring .= "currency_code=".urlencode(Yii::app()->params['paypal_currency'])."&";
        $querystring .= "return=".urlencode(stripslashes($return_url))."&";        
        $querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
        $querystring .= "notify_url=".urlencode(stripslashes($notify_url))."&";
        $querystring .= "rm=".urlencode(2)."&";
        $querystring .= "mrb=".urlencode('3FWGC6LFTMTUG')."&";
        $querystring .= "custom=".urlencode('myCustom')."&";
        $querystring .= "trxtype=".urlencode('D')."&";

        $index  = 1;
        foreach($aItems as $item)
        {
            $querystring .= "item_name_".$index."=".urlencode(stripslashes($item['item_name']))."&";
            $querystring .= "amount_".$index."=".urlencode(stripslashes($item['amount']))."&";
            $querystring .= "quantity_".$index."=".urlencode(stripslashes($item['quantity']))."&";
            $querystring .= "item_number_".$index."=".urlencode(stripslashes($item['item_number']))."&";
            $index++;
        }

        if($paypal_type == 'test')
            header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
        else
            header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
        exit;
    }

    //bb
    public static function isValid()
    {
        $verified = 0;
        require('ipnlistener.php');
        $listener = new IpnListener();

        if(Yii::app()->params['paypalType'] == 'test')
            $listener->use_sandbox = true;
        else            
            $listener->use_sandbox = false;

        try {
            $listener->requirePostMethod();
            $verified = $listener->processIpn();
        } catch (Exception $e) {
           
            echo ($e->getMessage());
            exit(0);
        }
        if ($verified) {
            $verified = 1;
//            echo $listener->getTextReport();
        } else {
            $verified = 0;
//            echo $listener->getTextReport();
        }
        return $verified;

    }
    
    //no need to use this function - just for test in rare cases
    public static function redirect_post($url, array $data, array $headers = null) 
    {
            $params = array(
                'http' => array(
                    'method' => 'POST',
                    'content' => http_build_query($data)
                )
            );
            if (!is_null($headers)) {
                $params['http']['header'] = '';
                foreach ($headers as $k => $v) {
                    $params['http']['header'] .= "$k: $v\n";
                }
            }
            
            $ctx = stream_context_create($params);            
            $fp = @fopen($url, 'rb', false, $ctx);           
            if ($fp) {                
                echo @stream_get_contents($fp);
                die();
            } else {
                // Error
                throw new Exception("Error loading '$url', $php_errormsg");
            }
    }
    

}