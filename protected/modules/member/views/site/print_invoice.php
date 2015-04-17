<div class="main clearfix" style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;padding:20px 0px 20px 0px;">
            <div style="float: left">
                <img src="<?php echo Yii::app()->createAbsoluteUrl('/').'/upload/img/invoice_logo.jpg'; ?>" />
            </div>
            <div style="float: right">
                    <h1>INVOICE</h1>
                    <table>
                        <tr>
                            <td><h5>DATE:</h5></td>
                            <td><h5><?php echo date('d-m-Y'); ?></h5></td>
                        </tr>
                        <tr>
                            <td><h5>INVOICE #:</h5></td>
                            <td><h5><?php echo $order->order_no; ?></h5></td>
                        </tr>
                    </table>
            </div>
        </div>

        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;">
            Regn #: <?php echo Yii::app()->params['regnNumber']; ?>
        </div>

        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif; padding:20px 0px 20px 0px;">
                <table style="border-collapse:collapse;border-spacing:0;width:50%;">
                    <tr>
                        <td style="padding: 5px;" >Customer:</td>
                        <td style="padding: 5px;" >
                            <?php
                            if(isset($order->user_id))
                            {
                                $user = Users::model()->findByPk($order->user_id);
                                if(!empty($user))
                                    echo $user->first_name.' '.$user->last_name;
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;"  >Bill Address:</td>
                        <td style="padding: 5px;" >
                            <?php 
                            $temp = json_decode($order->shipping_address, true);
                            // echo '<pre>';
                            // print_r(json_decode($order->shipping_address, true));
                            // echo '</pre>';
                            echo 'Address 1: '.$temp['address1'].'<br/>';
                            if(!empty($temp['address2']))
                                echo 'Address 2: '.$temp['address2'].'<br/>';
                             ?>
                        </td>
                    </tr>
                </table>
        </div>

        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif; padding:20px 0px 20px 0px;">
            Comments or special instructions: Template content will be amended by client
        </div>


        <div  style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;padding-top: 20px;">
            <div>
                <table style="border-collapse:collapse;border-spacing:0;width:100%;">
                    <thead>
                        <tr style="border: 1px solid #000;">
                            <td align="center"><h5><b></b></h5></td>
                            <td colspan="4" align="center"><h5><b>Description</b></h5></td>
                            <td align="center"><h5><b>Amount(S$)</b></h5></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center" style="border: 1px solid #000;">#</td>
                            <td align="center" style="border: 1px solid #000;">Name</td>
                            <td align="center" style="border: 1px solid #000;">Type</td>
                            <td align="center" style="border: 1px solid #000;">Quantity</td>
                            <td align="center" style="border: 1px solid #000;">Price</td>
                            <td align="center" style="border: 1px solid #000;"></td>
                        </tr>

                    <?php 
                        $stt = 0;
                        foreach($order->orderDetail as $item)
                        { 
                            $name = !empty($item->name) ? $item->name : "";
                            $stt++;
                            ?>
                        <tr style="border: 1px solid #000;">
                            <td style="padding:5px;text-align: center;border: 1px solid #000;"><?php echo $stt; ?></td>
                           <td  style="padding:5px;text-align: center;border: 1px solid #000;">
                                <?php echo $name; ?>
                            </td>
                            <td  style="padding:5px;text-align: center;border: 1px solid #000;">
                                <?php echo ($item->type==1) ? "Stationery" : "Print"; ?>
                            </td>
                            <td  style="padding:5px;text-align: center;border: 1px solid #000;"><?php echo $item->quantity; ?></td>
                            <td  style="padding:5px;text-align: center;border: 1px solid #000;"><?php echo Yii::app()->format->price($item->price);?></td>
                            <td  style="padding:5px;text-align: center;border: 1px solid #000;"><?php echo Yii::app()->format->price($item->sub_total) ;?></td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>

                    <tfoot style="padding-top: 30px;margin-top: 30px;">
                        <tr>
                            <td colspan="6" style="padding:5px"> &nbsp; </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding:5px"> &nbsp; </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:5px;border: 1px solid #000;" align="center" >
                                <b>Sub Total (S$) </b>                 
                            </td>
                            <td style="padding:5px;border: 1px solid #000;text-align:right;"><?php echo Yii::app()->format->price($order->sub_total);?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:5px;border: 1px solid #000;" align="center">
                               <b> Delivery Fee (S$)             </b>
                            </td>
                            <td style="padding:5px;border: 1px solid #000;text-align:right;"><?php echo Yii::app()->format->price($order->shipping_fee);?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:5px;border: 1px solid #000;" align="center">
                                <b>Total Exclusive of GST (S$)                </b>
                            </td>
                            <td style="padding:5px;border: 1px solid #000;text-align:right;"><?php echo Yii::app()->format->price($order->total_exclusive_gst);?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:5px;border: 1px solid #000;" align="center">
                                <b>GST (S$)                 </b>
                            </td>
                            <td style="padding:5px;border: 1px solid #000;text-align:right;"><?php echo Yii::app()->format->price($order->gst);?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:5px;border: 1px solid #000;" align="center">
                                <b>Total (S$)               </b>
                            </td>
                            <td style="padding:5px;border: 1px solid #000;text-align:right;"><?php echo Yii::app()->format->price($order->total);?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif; padding:20px 0px 20px 0px;">
            Cheque should be crossed and made payable to "SPEED PRINTZ PTE LTD"
        </div>

        <div style="height:50px;"></div>

        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif; padding:0px 0px 20px 0px; float: right;
            border-top: 1px solid #000;">
            Speed Printz Pte Ltd
        </div>

        <div style="height:50px;"></div>

        
        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif; padding:10px 0px 20px 0px; text-align: center;
            border-top: 1px solid #000;">
             Registered Address: 1 Queensway #03-01K Queensway Shopping Ctr/Twr Singapore 149053<br/>
             Tel: 96496310 (Edwin Teo) Website: www.speedprintz.com.sg   
        </div>





<?php /*
<style type="text/css">
    td{
        width: 100px;
    }
    .custommer{
        width: 200px;
    }
</style>
        <div class="main clearfix" style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;padding:20px 0px 20px 0px;">
        <table>
            <tr>
                <td style="width: 300px;">
                    <img src="<?php echo Yii::app()->createAbsoluteUrl('/').'/upload/img/invoice_logo.jpg'; ?>" />
                </td>
                <td style="width: 350px;" align="right">
                            <h1>INVOICE</h1>
                            <h5>DATE: <?php echo date('d-m-Y'); ?></h5>
                            <h5>INVOICE #: <?php echo $order->order_no; ?></h5>
                </td>
            </tr>
        </table>
        </div>

        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;">
            Regn #: <?php echo Yii::app()->params['regnNumber']; ?>
        </div>

        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif; padding:20px 0px 20px 0px;">
                <table style="border-collapse:collapse;border-spacing:0;width:50%;">
                    <tr>
                        <td style="padding: 5px;" >Customer:</td>
                        <td class="custommer" >
                            <?php
                            if(isset($order->user_id))
                            {
                                $user = Users::model()->findByPk($order->user_id);
                                if(!empty($user))
                                    echo $user->first_name.' '.$user->last_name;
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;"  >Bill Address:</td>
                        <td class="custommer" >
                            <?php 
                            $temp = json_decode($order->shipping_address, true);
                            // echo '<pre>';
                            // print_r(json_decode($order->shipping_address, true));
                            // echo '</pre>';
                            echo 'Address 1: '.$temp['address1'].'<br/>';
                            if(!empty($temp['address2']))
                                echo 'Address 2: '.$temp['address2'].'<br/>';
                             ?>
                        </td>
                    </tr>
                </table>
        </div>

        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif; padding:20px 0px 20px 0px;">
            Comments or special instructions: Template content will be amended by client
        </div>


        <div  style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;padding-top: 20px;">
            <div>
                <table style="border-collapse:collapse;border-spacing:0;width:100%;">
                    <thead>
                        <tr>
                            <td align="center" style="border: 1px solid #000;"><h5><b></b></h5></td>
                            <td colspan="4" align="center" style="border: 1px solid #000;"><h5><b>Description</b></h5></td>
                            <td align="center" style="border: 1px solid #000;"><h5><b>Amount(S$)</b></h5></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center" style="border: 1px solid #000;">#</td>
                            <td align="center" style="border: 1px solid #000;">Name</td>
                            <td align="center" style="border: 1px solid #000;">Type</td>
                            <td align="center" style="border: 1px solid #000;">Quantity</td>
                            <td align="center" style="border: 1px solid #000;">Price</td>
                            <td align="center" style="border: 1px solid #000;"></td>
                        </tr>

                    <?php 
                        $stt = 0;
                        foreach($order->orderDetail as $item)
                        { 
                            $name = !empty($item->name) ? $item->name : "";
                            $stt++;
                            ?>
                        <tr style="border: 1px solid #000;">
                            <td style="padding:5px;text-align: center;border: 1px solid #000;"><?php echo $stt; ?></td>
                           <td  style="padding:5px;text-align: center;border: 1px solid #000;">
                                <?php echo $name; ?>
                            </td>
                            <td  style="padding:5px;text-align: center;border: 1px solid #000;">
                                <?php echo ($item->type==1) ? "Stationery" : "Print"; ?>
                            </td>
                            <td  style="padding:5px;text-align: center;border: 1px solid #000;"><?php echo $item->quantity; ?></td>
                            <td  style="padding:5px;text-align: center;border: 1px solid #000;"><?php echo Yii::app()->format->price($item->price);?></td>
                            <td  style="padding:5px;text-align: center;border: 1px solid #000;"><?php echo Yii::app()->format->price($item->sub_total) ;?></td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>

                    <tfoot style="padding-top: 30px;margin-top: 30px;">
                        <tr>
                            <td colspan="6" style="padding:5px"> &nbsp; </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding:5px; border-bottom: 1px solid #000;"> &nbsp; </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:5px; border: 1px solid #000;" align="center" >
                                <b>Sub Total (S$) </b>                 
                            </td>
                            <td style="padding:5px;border: 1px solid #000;text-align:right;"><?php echo Yii::app()->format->price($order->sub_total);?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:5px;border: 1px solid #000;" align="center">
                               <b> Delivery Fee (S$)             </b>
                            </td>
                            <td style="padding:5px;border: 1px solid #000;text-align:right;"><?php echo Yii::app()->format->price($order->shipping_fee);?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:5px;border: 1px solid #000;" align="center">
                                <b>Total Exclusive of GST (S$)                </b>
                            </td>
                            <td style="padding:5px;border: 1px solid #000;text-align:right;"><?php echo Yii::app()->format->price($order->total_exclusive_gst);?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:5px;border: 1px solid #000;" align="center">
                                <b>GST (S$)                 </b>
                            </td>
                            <td style="padding:5px;border: 1px solid #000;text-align:right;"><?php echo Yii::app()->format->price($order->gst);?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="padding:5px;border: 1px solid #000;" align="center">
                                <b>Total (S$)               </b>
                            </td>
                            <td style="padding:5px;border: 1px solid #000;text-align:right;"><?php echo Yii::app()->format->price($order->total);?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif; padding:20px 0px 20px 0px;">
            Cheque should be crossed and made payable to "SPEED PRINTZ PTE LTD"
        </div>

        <div style="height:50px;"></div>

        <!-- <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif; padding:0px 0px 20px 0px;  border-top: 1px solid #000;">
            <span style="width:600px;">&nbsp;</span>Speed Printz Pte Ltd
        </div> -->

        <!-- <div style="height:50px;"></div> -->

        
        <div style="font-size: 12px;font-family: Arial, Helvetica, sans-serif; padding:10px 0px 20px 0px; text-align: center;
            border-top: 1px solid #000;">
             Registered Address: 1 Queensway #03-01K Queensway Shopping Ctr/Twr Singapore 149053<br/>
             Tel: 96496310 (Edwin Teo) Website: www.speedprintz.com.sg   
        </div>
*/ ?>