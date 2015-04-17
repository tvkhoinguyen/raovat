<?php
class CustomFormatter extends BaseFormatter
{
    public function formatCouponStatus($value) {
        if(is_array($value)) {
            return (($value['status'] == COUPON_STATUS_AVAILABLE) ?
				'Available'
                :
                'Used'
            );
        } else {
            return (($value == COUPON_STATUS_AVAILABLE) ?
				'Available'
                :
                'Used'
            );
		}
    }
	
	public function formatCouponMethods($value) {
        if(is_array($value)) {
            return (($value['method'] == COUPON_METHOD_PERCENTAGE) ?
				'Percentage'
                :
                'Dollar value'
            );
        } else {
            return (($value == COUPON_STATUS_AVAILABLE) ?
				'Percentage'
                :
                'Dollar value'
            );
		}
    }
	
	public function formatStatusSubScriber($value) {
        if(is_array($value)) {
            return (($value['status'] == STATUS_INACTIVE) ?
                CHtml::link(
                    "Unsubscribed",
                    array("ajaxActivate", "id"=>$value['id']),
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to ".DeclareHelper::$statusFormat[STATUS_ACTIVE],
                    )
                )
                :
                CHtml::link(
                    "Subscribed",
                    array("ajaxDeactivate", "id"=>$value['id']),
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to Unsubscribed",
                    )
                )
            );
        }
        else
            return $value == 0 ? "Unsubscribed" : "Subscribed";
    }   
    
    public function formatProductImage($value) {
        $img = '';
        if(is_array($value)) {
            if (file_exists(Yii::getPathOfAlias("webroot").'/upload/products/'.$value['product_id']."/".$value['color_id'].'/96x66/'.$value['image'])) {
                $img = '<img src="'.Yii::app()->createAbsoluteUrl('upload/products/'.$value['product_id']."/".$value['color_id']."/96x66/".$value['image']).'" class="rsTmb">';
            } else {
                $img = '<img src="'.Yii::app()->createAbsoluteUrl('upload/noimage/96x66.jpg').'" class="rsTmb">';
            }
        }
        return $img;
    }
    
    public function formatProductDefaultImage($value) {
        $img = '';
        if(is_array($value)) {
            $product_color_model = GocProductColor::findByProAndColor($value['product_id'], $value['color_id']);
            $default_image = GocProductImages::getDefaultImage($product_color_model->id);
            $img = '<img src="'.ImageHelper::getProductImage($value['product_id'], $value['color_id'], $default_image->image, '136', '104').'" />';
        }
        return $img;
    }


    public function formatIsDefault($value) {
        if(is_array($value)) {
            return (($value['value'] == TYPE_NO) ?
                CHtml::link(
                    "No",
                    //array(Yii::app()->createAbsoluteUrl('admin/productImages'), "id"=>$value['id'], "type" => $value['model']),"ajaxSetDefault"
                    Yii::app()->createAbsoluteUrl('admin/productImages/ajaxSetDefault', array("id"=>$value['id'], "type" => $value['model'])),    
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to set default",
                    )
                )
                :
                'Yes'
            );
        }
        else
            return $value == 0 ? DeclareHelper::$statusFormat[STATUS_INACTIVE] : DeclareHelper::$statusFormat[STATUS_ACTIVE];
    }

    /**
     * Author: @Phuong Ho
     * @param $value
     * @return string
     */
    public function formatStatusOrderFE($value) {
        $status = 'N/A';
        switch($value) {
            case ORDER_STATUS_ORDERED:
                $status = 'Ordered Successfully';
                break;
            case ORDER_STATUS_IN_SHIPMENT:
                $status = 'Pending Delivery';
                break;
            case ORDER_STATUS_IN_DELIVERED:
                $status = 'Delivered Successfully';
                break;
            case ORDER_STATUS_REFUNDED:
                $status = 'Refunded';
                break;
            case ORDER_STATUS_CANCELLED:
                $status = 'Cancelled';
                break;
        }
        return $status;
    }
    /**
     * Author: @Phuong Ho
     * @param $value
     * @return string
     */
    public function formatStringStatusOrderBE($value) {
        $status = 'N/A';
        switch($value) {
            case ORDER_STATUS_ORDERED:
                $status = 'Paid';
                break;
            case ORDER_STATUS_IN_SHIPMENT:
                $status = 'In Shipment';
                break;
            case ORDER_STATUS_IN_DELIVERED:
                $status = 'Delivered Successfully';
                break;
            case ORDER_STATUS_REFUNDED:
                $status = 'Refunded';
                break;
            case ORDER_STATUS_CANCELLED:
                $status = 'Cancelled';
                break;
            case ORDER_STATUS_PENDING:
                $status='Pending';
                break;
        }
        return $status;
    }

    /**
     * Author: @Phuong Ho
     * @param $value
     * @return string
     */
    public function formatStatusOrderBE($data) {
        $status = array();
        switch($data->status) {
            case ORDER_STATUS_ORDERED:
                $status = array(
                    ORDER_STATUS_ORDERED => 'Ordered Successfully',
                    ORDER_STATUS_IN_SHIPMENT => 'In Shipment',
                    ORDER_STATUS_IN_DELIVERED => 'Delivered Successfully',
                    ORDER_STATUS_CANCELLED => 'Cancelled',
                    ORDER_STATUS_REFUNDED => 'Refunded'
                );
                break;
            case ORDER_STATUS_IN_SHIPMENT:
                $status = array(
                    ORDER_STATUS_IN_SHIPMENT => 'In shipment',
                    ORDER_STATUS_IN_DELIVERED => 'Delivered Successfully',
                    ORDER_STATUS_CANCELLED => 'Cancelled',
                    ORDER_STATUS_REFUNDED => 'Refunded'
                );
                break;
            case ORDER_STATUS_IN_DELIVERED:
                $status = 'Delivered Successfully';
                break;
            case ORDER_STATUS_REFUNDED:
                $status = 'Refunded';
                break;
            case ORDER_STATUS_CANCELLED:
                $status = 'Cancelled';
                break;
        }
        if(is_array($status)) {
            return CHtml::dropDownList('status', $data->status, $status, array('order_id' => $data->id));
        } else {
            return $status;
        }

    }

}