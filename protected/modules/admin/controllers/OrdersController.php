<?php

class OrdersController extends AdminController
{
    public $pluralTitle = 'Order Management';
    public $singleTitle = 'Order';
    public $cannotDelete = array();

    public function actionCreate($email = null)
    {
        try {
            if ($email == null) {
                $model = new SpOrders('findUser');   
                if (isset($_POST['SpOrders'])) {
                    $model->attributes = $_POST['SpOrders'];
                    // $model->agreeTermOfUse = true;
                    if (isset(Yii::app()->session['session_order_id'])) {
                        unset(Yii::app()->session['session_order_id']);
                    }
                    if (isset($_POST['SpOrders']['user_email']) && $_POST['SpOrders']['user_email'] != '') {
                        $tmp = explode('-', $_POST['SpOrders']['user_email']);
                        $model->user_email = trim($tmp[0]);
                    }
                    if ($model->validate()) {
                        $e_email = base64_encode($model->user_email);
                        $this->redirect(array('create', 'email' => $e_email));
                    }
                }
                $this->render('create', array(
                    'model' => $model,
                    'actions' => $this->listActionsCanAccess,
                ));
            } else {  
                $e_email = base64_decode($email);
                $user = Users::findByEmail($e_email);
                $model = array();
                if (isset(Yii::app()->session['session_order_id'])) {
                    $model = SpOrders::model()->findByPk(Yii::app()->session['session_order_id']);
                }                 
                            
                $this->render('create', array(
                    'model' => $model,
                    'actions' => $this->listActionsCanAccess
                ));
            }
        } catch (exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException($e);
        }
    }
    
    public function actionAddStationery($email) {
        $model = new SpStationeries('addBE');
        if (isset($_POST['SpStationeries'])) {
            $model->attributes = $_POST['SpStationeries'];
            if ($model->validate()) {
                $id = $_POST['SpStationeries']['id'];
                $quantity = $_POST['SpStationeries']['quantity'];
                if (!isset(Yii::app()->session['session_order_id'])) {
                    $order_id = $this->createOrder($email, $id, $quantity);
                    $this->setNotifyMessage(NotificationType::Success, 'Add to cart successfully');
                    $this->redirect(Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => $email)));
                } else {
                    $order_id = Yii::app()->session['session_order_id'];
                    $check_exist = SpOrderDetails::checkItemExist($id, $order_id);
                    if ($check_exist == false) {
                        $this->addCart($order_id, $id, $quantity);
                        $this->setNotifyMessage(NotificationType::Success, 'Add to cart successfully');
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => $email)));
                    } else {
                        $this->setNotifyMessage(NotificationType::Error, 'This product has been exist in your cart');
                    }
                }                
            }
        }
        $this->render('add_stationery', array(
            'model' => $model
        ));
    }
    
    public function createOrder($email, $id, $quantity) {
        $model = new SpOrders();
        $model->order_no = SpOrders::genReferenceNumber();;
        $model->status = ORDER_CURRENT_CART; //-1
        $e_email = base64_decode($email);
        $user = Users::findByEmail($e_email);
        if (!empty($user)) {
            $model->user_id = $user->id;
            $model->user_name = $user->full_name;
            //$model->shipping_fee = SpShippingFee::getShippingFee($user->area_code_id);
        }
        if ($model->save()) {
            Yii::app()->session['session_order_id'] = $model->id;
            $this->addCart($model->id, $id, $quantity);
        }
        return $model->id;
    }
    
    public function createPrintOrder($email, $name, $price, $quantity) {
        $model = new SpOrders();
        $model->order_no = SpOrders::genReferenceNumber();
        $model->status = ORDER_CURRENT_CART; //-1 
        $e_email = base64_decode($email);
        $user = Users::findByEmail($e_email);
        if (!empty($user)) {
            $model->user_id = $user->id;
            $model->user_name = $user->full_name;
            //$model->shipping_fee = SpShippingFee::getShippingFee($user->area_code_id);
        }
        if ($model->save()) {
            Yii::app()->session['session_order_id'] = $model->id;
            $this->addPrintCart($model->id, $name, $price, $quantity);
        }
        return $model->id;
    }
    
    public function addCart($order_id, $id, $quantity) {
        $model = new SpOrderDetails();
        $stationery = SpStationeries::model()->findByPk($id);
        $model->order_id    = $order_id;
        $model->quantity    = $quantity;
        $model->name        = $stationery->name;
        $model->product_id  = $id;
        $model->price       = $stationery->price;
        $model->type        = ITEM_TYPE_STATIONERY;
        $model->sub_total   = $quantity * $stationery->price;
        if ($model->save()) {
            SpOrders::updateOrder($order_id);
        }
    } 
    
    public function addPrintCart($order_id, $name, $price, $quantity) {
        $model = new SpOrderDetails();
        $stationery = SpStationeries::model()->findByPk($id);
        $model->order_id    = $order_id;
        $model->quantity    = $quantity;
        $model->name        = $name;
        $model->price       = $price;
        $model->type        = ITEM_TYPE_PRINT;
        $model->sub_total   = $price;        
        if ($model->save()) {            
            SpOrders::updateOrder($order_id);
        }
    } 
    
    public function actionAddPrint($email) {    
        $model = new SpPriceCalculatorForm('create');
        $category = PrintCategories::model()->findByPk(1);
        $extra_features = ExtraFeatures::getItemByCategory($category->id);
            
        $meterial_id = PrintPrice::getMeterialList($category->id);
        $material = PrintMaterial::findByArrId($meterial_id);

        $size_pager_id = PrintPrice::getSizePaperList($category->id);
        $size_paper = PrintSizePaper::findByArrId($size_pager_id);

        $printing_side_id = PrintPrice::getPrintingSide($category->id);
        $printing_side = PrintingSide::findByArrId($printing_side_id);

        $finishing_id = FinishingPrice::findFinishingIdByCat($category->id);
        $finishing = Finishing::findByArrId($finishing_id, 'select');

        $set_id = PrintPrice::getSet($category->id);
        $set = Unit::findByArrId($set_id);
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['SpPriceCalculatorForm'];
            $str = '';
            if (isset($_POST['SpPriceCalculatorForm']['row'])) {
                $quantity = 0;
                $set_arr = array(); 
                $a = array();
                foreach ($_POST['SpPriceCalculatorForm']['row'] as $item) {
                    $set_arr[$item['sub_set']]['set'] = $item['sub_set'];
                    if (!in_array($item['sub_set'], $a)) {                            
                        $set_arr[$item['sub_set']]['quantity'] = $item['sub_quantity'];
                        $a[] = $item['sub_set'];
                    } else {
                        $set_arr[$item['sub_set']]['quantity'] = $set_arr[$item['sub_set']]['quantity'] + $item['sub_quantity'];
                    }                        
                }
                foreach ($set_arr as $val) {
                    $str .= " + [Set ".$val['set'] . ', Quantity '.$val['quantity'].']';
                    $quantity = $quantity + $val['quantity'];
                }
            }
            $name = $_POST['SpPriceCalculatorForm']['name'] . $str;
            $price = $_POST['SpPriceCalculatorForm']['price'];
            $model->name        = $name;
            $model->price       = $price;
            $model->category    = $_POST['SpPriceCalculatorForm']['category'];
            $model->attachments = CUploadedFile::getInstance($model, 'attachments');
            $model->quantity    = $quantity;
            if ($model->validate()) {
                if (!isset(Yii::app()->session['session_order_id'])) {
                    $order_id = $this->createPrintOrder($email, $name, $price, $quantity);                        
                } else {
                    $order_id = Yii::app()->session['session_order_id'];
                    $this->addPrintCart($order_id, $name, $price, $quantity);
                }

                if (isset($order_id)) {
                    $fid = SpOrderDetails::findNewDetail($order_id);
                    $order_detail = SpOrderDetails::model()->findByPk($fid);
                    $order_detail->instructions = $model->print_instructions;
                    if (!empty($model->attachments)) {
                        $ext_banner = $model->attachments->getExtensionName();
                        $timestamp_banner = time();
                        $order_detail->attachments = $timestamp_banner . '.' . $ext_banner;
                    }
                    if (!empty($model->attachments)) {                            
                        $att_upload = new ImageHelper();
                        $att_upload->createDirectoryByPath('upload/prints/' . $fid);
                        $model->attachments->saveAs(YII_UPLOAD_DIR . '/prints/' . $fid . '/' . $order_detail->attachments);
                        $order_detail->update();
                    }                   
                }
                $this->setNotifyMessage(NotificationType::Success, 'Add to cart successfully');
                $this->redirect(Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => $email)));
            } else {
                $this->setNotifyMessage(NotificationType::Error, 'Cannot add to cart');
            }
        }
        $this->render('add_print', array(
            'category' => $category,
            'model' => $model,
            'material' => $material,
            'size_paper' => $size_paper, 
            'printing_side' => $printing_side,
            'finishing' => $finishing,
            'extra_features' => $extra_features,
            'set' => $set
        ));
    }
    
    public function actionCheckout($email) {
        if (!isset(Yii::app()->session['session_order_id'])) {
            $this->setNotifyMessage(NotificationType::Error, 'Empty product');
            $this->redirect(Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => $email)));
        }
        $order = SpOrders::model()->findByPk(Yii::app()->session['session_order_id']);
        $e_email = base64_decode($email);
        $user = Users::findByEmail($e_email);
        if (!empty($user)) {
            $billing_model = SpBillingAddress::model()->findByPk($user->id);
            $shipping_model = SpShippingAddress::model()->findByPk($user->id);
            $billing_model->contact_first_name = $user->first_name;
            $billing_model->contact_last_name = $user->last_name;
            $shipping_model->contact_first_name = $user->first_name;
            $shipping_model->contact_last_name = $user->last_name;
        } else {
            $billing_model = new SpBillingAddress('checkoutFE2');
            $shipping_model = new SpShippingAddress('create_BE');
            $billing_model->area_code_id = '';
        }
        $shipping_model->scenario = 'create_BE';
        if (Yii::app()->request->isPostRequest) { 
            $billing_model->attributes = $_POST['SpBillingAddress'];
            $billing_model->agreeTermOfUse = TYPE_YES;
            $shipping_model->attributes = $_POST['SpShippingAddress'];
            $bill_v = $billing_model->validate();
            $ship_v = $shipping_model->validate();   
            if($bill_v && $ship_v) {
                $order->billing_address = json_encode($_POST['SpBillingAddress']);
                $order->shipping_address = json_encode($_POST['SpShippingAddress']);
                $order->status = ORDER_STATUS_PENDING;
                $order->update();
                unset(Yii::app()->session['session_order_id']);
                $items = SpOrders::getItemsInTable($order);
                SendEmail::sendNotifyOrderMemberPaypal($order, $items);
                SendEmail::sendNotifyOrderAdminPaypal($order, $items);
                $this->setNotifyMessage(NotificationType::Success, 'Add order successfully');
                $this->redirect(Yii::app()->createAbsoluteUrl('admin/orders'));
            } else {
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
            }
        }
        if (!empty($order->billing_address)) {
            $billing_model->attributes = json_decode($order->billing_address, true);
        }
        $this->render('checkout', array(
            'model' => $billing_model,
            'order' => $order,
            'shipping_model' => $shipping_model
        ));
    }
    
    public function actionShippingFee() {
        $this->layout = 'ajax';
        if (Yii::app()->request->isPostRequest) {
            $order = SpOrders::model()->findByPk(Yii::app()->session['order_ss_id']);
            $shipping_fee = SpShippingFee::getShippingFee($_POST['country_id']);
            $order->shipping_fee =  $shipping_fee;
            $order->update(array('shipping_fee'));
            SpOrders::updateOrder($order->id);
            if (isset(Yii::app()->session['order_ss_id'])) {
                $order = SpOrders::model()->findByPk(Yii::app()->session['order_ss_id']);
                $this->renderPartial('tab/_cart_summary',
                    array('order'=>$order) 
                );
            }
        } else {
            Yii::log("Invalid request. Please do not repeat this request again.");
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
    
    public function actionGetOption() {
        $this->layout = 'ajax';
        $meta = array();
        if(Yii::app()->request->isPostRequest) {
            $cat_id = $_POST['id'];
            $meterial_id = PrintPrice::getMeterialList($cat_id);
            $material = PrintMaterial::findByArrId($meterial_id);
            $meta['material'] = $material;
            
            $size_pager_id = PrintPrice::getSizePaperList($cat_id);
            $size_paper = PrintSizePaper::findByArrId($size_pager_id);
            $meta['size_paper'] = $size_paper;
            
            $extra_features = ExtraFeatures::getItemByCategory($cat_id);
            $meta['extra_features'] = $extra_features;
            
            $printing_side_id = PrintPrice::getPrintingSide($cat_id);
            $printing_side = PrintingSide::findByArrId($printing_side_id);
            $meta['printing_side'] = $printing_side;
            
            $finishing_id = FinishingPrice::findFinishingIdByCat($cat_id);
            $finishing = Finishing::findByArrId($finishing_id, 'select');
            $meta['finishing'] = $finishing;
            
            $set_id = PrintPrice::getSet($cat_id);
            $set = Unit::findByArrId($set_id);
            $meta['set'] = $set;
            
            $category = PrintCategories::model()->findByPk($cat_id);
            $meta['lead_time_from'] = $category->lead_time_from;
            $meta['lead_time_to'] = $category->lead_time_to;
        }
        echo json_encode($meta);
    }
    
    public function actionAddRecord() {
        $this->layout = 'ajax';
        $data = $_POST['SpPriceCalculatorForm'];        
        $flag = true;
        $name = array();
        $name_not_set = array();
        $meta = array();
        $meta['mess'] = '';
        $meta['td_html'] = '';
        $criteria = new CDbCriteria;
        $extract = new CDbCriteria;
        $extract_price = 0;
        if (isset($data['category'])) {
            $category = PrintCategories::model()->findByPk($data['category']);
            $name[] = $category->name;
            $name_not_set[] = $category->name;
            $criteria->compare('t.print_category_id', $category->id);
            $extract->compare('t.print_category_id', $category->id);
        }
        if (isset($data['material'])) {
            $meterial = PrintMaterial::model()->findByPk($data['material']);
            $name[] = $meterial->name;
            $name_not_set[] = $meterial->name;
            $criteria->compare('t.material_id', $meterial->id);
            $extract->compare('t.material_id', $meterial->id);
        }
        if (isset($data['size_of_paper']) && $data['size_of_paper'] != '') {
            $size_of_paper = PrintSizePaper::model()->findByPk($data['size_of_paper']);
            $name[] = $size_of_paper->name;
            $name_not_set[] = $size_of_paper->name;
            $criteria->compare('t.size_paper_id', $size_of_paper->id);
        }
        if (isset($data['printing_side']) && $data['printing_side'] != '') {
            $printing_side = PrintingSide::model()->findByPk($data['printing_side']);
            $name[] = $printing_side->name;
            $name_not_set[] = $printing_side->name;
            $criteria->compare('t.printing_side_id', $printing_side->id);
        }
        if (isset($data['finishing']) && $data['finishing'] != '') {
            $finishing = Finishing::model()->findByPk($data['finishing']);
            $name[] = $finishing->name;
            $name_not_set[] = $finishing->name;
            if (isset($data['size_of_paper']) && isset($data['no_of_sets'])) {
                if (isset($data['printing_side'])) {
                    $finishing_price = FinishingPrice::getPrice($data['size_of_paper'], $data['finishing'], $data['no_of_sets'], $data['printing_side']);
                } else {
                    $finishing_price = FinishingPrice::getPrice($data['size_of_paper'], $data['finishing'], $data['no_of_sets']);
                }
            } else {
                $finishing_price = 0;
            }
        }
        if (isset($data['no_of_sets'])) {
            $set = Unit::model()->findByPk($data['no_of_sets']);
            $name[] = $set->value;
            $criteria->compare('t.set_id', $set->id);
            $extract->compare('t.set_id', $set->id);
        }
        if (isset($data['extra_features']) && $data['extra_features'] != '') {
            $extra_features = ExtraFeatures::model()->findByPk($data['extra_features']);
            $name[] = $extra_features->name;
            $name_not_set = $extra_features->name;
            $etr_price = PrintExtraFeatures::model()->find($extract);
            if (!empty($etr_price)) {
                $extract_price = $etr_price->price;
            }
        }
        $name[] = $category->lead_time_from . '-'. $category->lead_time_to . ' working days (default)';
        $name_not_set[] = $category->lead_time_from . '-'. $category->lead_time_to . ' working days (default)';
        $print_price = PrintPrice::model()->find($criteria);
        $meta['name_result'] = implode(' + ', $name);
        $meta['name_not_set'] = implode(' + ', $name_not_set);
        if (!empty($print_price)) {
            $price = $finishing_price + $print_price->price + $extract_price;             
        } else {
            $price = 0;
        }
        if ($price == 0) {
            $meta['mess'] = 'Unfortunately, the configuration you selected is not available.';
            $flag = false;
        } 
        if ($meta['name_not_set'] != $data['name_not_set'] && $data['name_not_set'] != '') {
            $meta['mess'] = 'editoption';
        }
        if (empty($data['quantity'])) {
            $meta['mess'] = 'Please input quantity';
            $flag = false;
        }
        if ($flag == true) {
            $html = '';
            $html .= '<tr>';
            $html .= '<td style="text-align: right">' . $set->value . '<input name="SpPriceCalculatorForm[row][sub_set][]" value="'.$set->value.'" type="hidden" class="sub_set" /></td>';
            $html .= '<td style="text-align: right">' . $data['quantity'].'<input name="SpPriceCalculatorForm[row][sub_quantity][]" value="'.$data['quantity'].'" type="hidden" class="quantity_list" /></td>';
            $html .= '<td style="text-align: right">' . Yii::app()->format->price($price * $data['quantity']) . '<input name="SpPriceCalculatorForm[row][sub_price][]" value="'.$price * $data['quantity'].'" type="hidden" class="sub_price" /></td>';        
            $html .= '<td style="text-align: right"><a href="#" title="delete" class="btn-delete"><img src="' . Yii::app()->theme->baseUrl . '/img/ico-delete.png" alt="delete" /></a></td>';
            $html .= '</tr>';
            $meta['td_html'] = $html;
        }
        
        $meta['price_result'] = $price->price;
        $meta['quantity'] = $data['quantity'];        

        echo json_encode($meta);
    }


    public static function actionGetStationeryProduct() {
        $key = $_GET['term'];
        $criteria = new CDbCriteria;
        $criteria->compare('t.name', $key, true);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $result = SpStationeries::model()->findAll($criteria);
        $data = array();
        foreach ($result as $item) {
            $data[] = array('label' => $item->name, 'id' => $item->id);
        }
        echo json_encode($data);
    }
    
    public function actionGetFeature() {
        $this->layout = 'ajax';
        if(Yii::app()->request->isPostRequest) {
            $cat_id = $_POST['cat_id'];
            $me_id = $_POST['me_id'];
            $meta = array();
            $extra_features_id = PrintExtraFeatures::getExtraList($cat_id, $me_id);
            $extra_features = ExtraFeatures::findByArrId($extra_features_id);
            $meta['feature'] = $extra_features;
            echo json_encode($meta);
        }
    }

    public function actionConfirm($id) {
        try {
            $model = $this->loadModel($id);
            $model_detail = GocOrderDetails::findByOrderId($id);
            $total = SpOrders::getListTotalCart($id);
            $shipping_address = json_decode($model->shipping_address);
            if (isset($_POST['SpOrders'])) {
                $model->attributes = $_POST['SpOrders'];
                $model->status = ORDER_STATUS_ORDERED;
                if (empty($model->user_id)) {
                    $model->user_name = $shipping_address->contact_first_name . ' ' . $shipping_address->contact_last_name;
                }
                if ($model->update()) {
                    $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $items = SpOrders::model()->getItemsInTable($model);
                    SendEmail::sendNotifyOrderMemberPaypal($model, $items);
                    unset(Yii::app()->session['session_order_id']);
                    $this->redirect(array('index'));
                } 
            }
            
            $discount_model = new DiscountForm();
            if (isset($_POST['DiscountForm'])) {
                if ($_POST['DiscountForm']['type'] == 'apply') {
                    $discount_model->attributes = $_POST['DiscountForm'];
                    $discount_model->order_id = $id;
                    if ($discount_model->validate()) {
                        $message = GocCoupons::checkDiscountCode($discount_model->discount_code);
                        if ($message != '') {
                            $this->setNotifyMessage(NotificationType::Error, $message);
                            $discount_model->discount_code = $_POST['DiscountForm']['discount_code'];
                            $this->redirect(array('confirm', 'id' => $id));
                        } else {
                            $this->updateDiscount($id, $discount_model->discount_code);
                            $this->setNotifyMessage(NotificationType::Success, 'Order has been apply discount');
                            $this->redirect(array('confirm', 'id' => $id));
                        }
                    }
                } else {
                    if ($this->deleteCoupon($id) == TYPE_YES) {
                        $this->setNotifyMessage(NotificationType::Success, 'Delete coupon code succesfully.');
                        $this->redirect(array('confirm', 'id' => $id));
                    } else {
                        $this->setNotifyMessage(NotificationType::Error, 'Cannot delete.');
                        $this->redirect(array('confirm', 'id' => $id));
                    }
                }
            }
            $this->render('confirm', array(
                'model' => $model,
                'model_detail' => $model_detail,
                'total' => $total,
                'discount_model' => $discount_model
            ));
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }
    
    public function deleteCoupon($order_id) {
        $model_order = SpOrders::model()->findByPk($order_id);
        $model_couponHistory = GocCouponsHistory::checkCouponOrderExist_getModel($order_id);
        $model_coupon_his = GocCouponsHistory::model()->findByPk($model_couponHistory->id);
        $model_coupon_code = GocCoupons::model()->findByAttributes(array('code' => $model_couponHistory->coupon_code));
        $i=0;
        if(!empty($model_order))
        {
            $model_order->coupon_code ='';
            $model_order->update( array('coupon_code') );
            $i++;
        }

        if(!empty($model_coupon_his))
        {
            $model_coupon_his->delete();
            $i++;
        }

        if(!empty($model_coupon_code))
        {
            if($model_coupon_code->no_of_use==0 && $model_coupon_code->status==COUPON_STATUS_USED )
            {
                $model_coupon_code->no_of_use = 1;
                $model_coupon_code->status    = COUPON_STATUS_AVAILABLE;
                $model_coupon_code->update( array('no_of_use','status') );
            }else if($model_coupon_code->no_of_use>=1 && $model_coupon_code->status==COUPON_STATUS_AVAILABLE )
            {
                $model_coupon_code->no_of_use = $model_coupon_code->no_of_use+1;
                $model_coupon_code->status    = COUPON_STATUS_AVAILABLE;
                $model_coupon_code->update( array('no_of_use','status') );
            }
            $i++;
        }
        if ($i==3)
            return 1;
        else
            return 0;
    }


    public function updateDiscount($order_id, $discount_code) {     
        $order = SpOrders::model()->findByPk($order_id);
        $discount = SpOrders::getDiscountByCouponCode($order_id, $discount_code);

        $order->coupon_code = $discount_code;
        $order->discount = $discount;
        $order->update(array('coupon_code', 'discount_code')); // update discount

        $coupon_history = new GocCouponsHistory();
        $coupon_history->coupon_code = $order->coupon_code;
        $coupon_history->discount = $order->discount;
        $coupon_history->order_id = $order->id;
        $coupon_history->user_id = $order->user_id;
        $coupon_history->save(false); // save coupon history

        $coupon = GocCoupons::model()->findByAttributes(array('code' => $order->coupon_code));
        if(!empty($coupon))
        {
            if($coupon->no_of_use == 1) {
                $coupon->no_of_use = 0;
                $coupon->status = COUPON_STATUS_USED;
            } else if($coupon->no_of_use) {
                $coupon->no_of_use = $coupon->no_of_use - 1;
                $coupon->status = COUPON_STATUS_AVAILABLE;
            }
            $coupon->update(array('no_of_use', 'status')); // update coupon no_of_use
        }
    }

    public function actionDelete($id)
    {
        try {
            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                if (!in_array($id, $this->cannotDelete)) {
                    if ($model = $this->loadModel($id)) {
                        if ($model->delete())
                            Yii::log("Delete record " . print_r($model->attributes, true), 'info');
                    }

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                }
            } else {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }
    
    public function actionDeleteOrderDetail($id) {
        try {
            if (Yii::app()->request->isPostRequest) { 
                $model = GocOrderDetails::model()->findByPk($id);
                if ($model->delete()) {
                     Yii::log("Delete record " . print_r($model->attributes, true), 'info');
                }
            }                
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }

    public function actionIndex()
    {
        try {
            $model = new SpOrders('search');
            $model->unsetAttributes(); // clear any default values
            if (isset($_GET['SpOrders'])){
                $model->attributes = $_GET['SpOrders'];
                $model->from_date = DateHelper::toDbDateFormat($_GET['SpOrders']['from_date']);
                $model->to_date = DateHelper::toDbDateFormat($_GET['SpOrders']['to_date']);
            }
            $this->render('index', array(
                'model' => $model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $billing_model = new SpBillingAddress('create_BE');
        $shipping_model = new SpShippingAddress('create_BE');
        $old_status = $model->status;
        if (!empty($model->billing_address)) {
            $billing_model->attributes = json_decode($model->billing_address, true);
            $old_shipping_country = $billing_model->area_code_id;
        }
        if (!empty($model->shipping_address)) {
            $shipping_model->attributes = json_decode($model->shipping_address, true);
            $old_shipping_country = $shipping_model->area_code_id;
        }

        if (isset($_POST['SpOrders'])) {
            $model->attributes = $_POST['SpOrders'];
            // $model->agreeTermOfUse = true;
            $billing_model->attributes = $_POST['SpBillingAddress'];
            $billing_model->agreeTermOfUse = true;
            $shipping_model->attributes = $_POST['SpShippingAddress'];
            if ($model->validate() && $billing_model->validate() && $shipping_model->validate()) {
                $model->billing_address = json_encode($_POST['SpBillingAddress']);
                $model->shipping_address = json_encode($_POST['SpShippingAddress']);
                if ($_POST['SpBillingAddress']['area_code_id'] != $old_shipping_country) {
                    $shipping_fee = SpShippingFee::getShippingFee($_POST['SpBillingAddress']['area_code_id']);
                    $model->shipping_fee =  $shipping_fee;
                }
                $model->save();
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                if ($_POST['SpOrders']['status'] != $old_status) {
                    $items = SpOrders::model()->getItemsInTable($model);
                    SendEmail::sendNotifyOrderUpdateStatusToMember($model,$items, $model->status); // send mail notify to member
                }                
                $this->redirect(array('view', 'id' => $model->id));
            } else{
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
            }
        }

        //$model->beforeRender();
        $this->render('update', array(
            'model' => $model,
            'billing_model' => $billing_model,
            'shipping_model' => $shipping_model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->order_no
        ));
    }


    public function actionView($id)
    {
        //try {
            $model = $this->loadModel($id);
            $this->render('view', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->order_no
            ));
        /*} catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }*/
    }

    /*
    * Bulk delete
    * If you don't want to delete some specified record please configure it in global $cannotDelete variable
    */
    public function actionDeleteAll()
    {
        $deleteItems = $_POST['goc-orders-grid_c0'];
        $shouldDelete = array_diff($deleteItems, $this->cannotDelete);

        if (!empty($shouldDelete)) {
            SpOrders::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
            $this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
        } else
            $this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }


    public function loadModel($id)
    {
        //need this define for inherit model case. Form will render parent model name in control if we don't have this line
        $initMode = new SpOrders();
        $model = $initMode->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    /**
     * @Huu Thoa
     * get user info autocomplate
     */
    public function actionGetUser() {
        $key = $_GET['term'];
        $criteria = new CDbCriteria;
        $criteria->compare('t.email', $key, true);
        $criteria->compare('t.application_id', FE);
        $criteria->compare('t.role_id', ROLE_MEMBER);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $result = Users::model()->findAll($criteria);
        $data = array();
        foreach ($result as $item) {
            $data[] = array('label' => $item->email . ' - ' . $item->first_name. ' ' . $item->last_name, 'id' => $item->id);
        }
        echo json_encode($data);
    }
    
    /*
     * @Huu Thoa
     */
    public function actionGetProduct() {
        $key = $_GET['term'];
        $criteria = new CDbCriteria;
        $criteria->compare('t.name', $key, true);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $result = GocProducts::model()->findAll($criteria);
        $data = array();
        foreach ($result as $item) {
            if (GocProductPrice::getPriceEffective_nonDiscount($item->id) != "Unavailable") {
                $data[] = array('label' => $item->name . ' - ' . $item->code, 'id' => $item->id);
            }
        }
        echo json_encode($data);
    }
    
    /*
     * @Huu Thoa
     */
    public function actionProductInfo() {
        $pro_id = $_POST['id'];
        //Get color
        $colors = GocProductColor::findByProductId($pro_id);
        $arr_color = array();
        //$arr_color[] = array('id' => '', 'name' => 'select');
        foreach ($colors as $i_color) {
            $arr_color[] = array('id' => $i_color->color_id, 'name' => $i_color->color->name);
        }
        //Get size
        $sizes = GocProductSize::findByProductId($pro_id);
        $arr_size = array();
        foreach ($sizes as $i_size) {
            $arr_size[] = array('id' => $i_size->size_id, 'name' => $i_size->size->name);
        }
        //Get style
        $styles = GocProductStyle::findByProductId($pro_id);
        $arr_style = array();
        foreach ($styles as $i_style) {
            $arr_style[] = array('id' => $i_style->style_id, 'name' => $i_style->style->name);
        }
        $data = array('color' => $arr_color, 'size' => $arr_size, 'style' => $arr_style);
        echo json_encode($data);
    }


    /*
     * @Huu Thoa
     * Admin add product to order
     */
    public function actionAddCart($email) {
        try {
            $model = new GocOrderDetails('createBe');
            if (isset($_POST['GocOrderDetails'])) {                
                $model->attributes = $_POST['GocOrderDetails'];
                if (!empty($model->style_id)) {
                    $style = GocMasterStyle::model()->findByPk($model->style_id);
                    $model->product_style = $style->name;
                }
                if (!empty($model->size_id)) {
                    $size = GocMasterSizes::model()->findByPk($model->size_id);
                    $model->product_size = $size->name;
                }
                if (!empty($model->color_id)) {
                    $color = GocMasterColors::model()->findByPk($model->color_id);
                    $model->product_color = $color->name;
                }
                if (!empty($model->product_id)) {
                    $product = GocProducts::model()->findByPk($model->product_id);
                    $model->product_code = $product->code;
                    $model->price = GocProductPrice::getPriceEffective_nonDiscount($model->product_id);
                    $model->price_discount = GocProductPrice::getPriceEffective($model->product_id);
                    $model->product_size_id = $model->size_id;
                    $model->product_color_id = $model->color_id;
                }
                if (isset(Yii::app()->session['session_order_id'])) {
                    $model->order_id = Yii::app()->session['session_order_id'];
                    if($model->save()){
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => $email)));
                    }
                } else {
                    $model->id = 0;//Add temp
                    if ($model->validate()) {
                        //Save order
                        $model_order = new SpOrders();
                        $model_order->order_no = StringHelper::getRandomString(10, 'uppercase_number');
                        $e_email = base64_decode($email);
                        $user = Users::findByEmail($e_email);
                        if (!empty($user)) {
                            $model_order->user_id = $user->id;
                            $model_order->user_name = $user->full_name;
                        }
                        $model_order->created_date = date('Y-m-d H:i:s');
                        $model_order->status = ORDER_CURRENT_CART_BE; //-2
                        if ($model_order->save(false)) {
                            Yii::app()->session['session_order_id'] = $model_order->id;
                            $model->order_id = $model_order->id;
                            if($model->save()){
                                $this->redirect(Yii::app()->createAbsoluteUrl('admin/orders/create', array('email' => $email)));
                            }
                        }
                    }
                }                
            }
            $this->render('add_cart', array(
                'model' => $model
            ));
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }

    /**
     * Author: @Phuong Ho
     * @param $id
     */
    public function actionDownloadInvoice($id) {
        $this->redirect(Yii::app()->createAbsoluteUrl('site/downloadInvoice', array('order_id' => base64_encode($id))));
    }
    public function actionUpdateStatus() {
        try {
            if (Yii::app()->request->isPostRequest) {
                $model = $this->loadModel($_POST['order_id']);
                $model->status = $_POST['status'];
                $model->update('status'); // update status order
                $items = SpOrders::model()->getItemsInTable($model);
                SendEmail::sendNotifyOrderUpdateStatusToMember($model,$items, $model->status); // send mail notify to member
            } else {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw  new CHttpException($e);
        }
    }

}