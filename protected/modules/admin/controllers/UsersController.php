<?php

class UsersController extends AdminController {

    public $pluralTitle = 'User Management';
    public $singleTitle = 'User';
    public $cannotDetele = array();

    public function actionCreate() {
        try {
            $model = new Users('CreateAgentBE');
            $model->status = STATUS_ACTIVE;
            $model->role_id = ROLE_MEMBER;
            $model->application_id = FE;
            $model->created_date = date('Y-m-d H:i:s');
            
            if (isset($_POST['Users'])) {                
                $model->attributes = $_POST['Users'];
                $model->address2 = $_POST['Users']['address2'];
                $model->temp_password = $_POST['Users']['temp_password'];
                $model->password_confirm = $_POST['Users']['password_confirm'];
                if ($model->validate()) 
                {
                    $model->password_hash = md5($model->temp_password);
                    $model->full_name = $model->first_name. ' ' . $model->last_name;
                    if( $model->save() )
                    {
                        $model_sub = new Subscriber();
                        $model_sub->name = $model->full_name;
                        $model_sub->email = $model->email;
                        $model_sub->subscriber_group_id = array('2'); //MEMBER
                        $model_sub->status = STATUS_ACTIVE;
                        if($model_sub->validate())
                        {
                            $model_sub->subscriber_group_id =json_encode($model_sub->subscriber_group_id);
                            if($model_sub->save(false))
                            {
                                $model_sub->saveMuilGroupSubscriber();
                                // $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                                // $this->redirect(array('view', 'id'=> $model_sub->id));
                            }
                        }

                        SendEmail::registerSucceedMailToUser($model);
                        //SendEmail::registerSucceedMailToAdmin($model);
                        $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                } else {
                    $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
                }
            }
            $this->render('create', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
        } catch (exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException($e);
        }
    }

    public function actionDelete($id) {
        try {
            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                if (!in_array($id, $this->cannotDetele)) {
                    if ($model = $this->loadModel($id)) {                            
                        SendEmail::noticeChangPasswordSucceedToAdmin($model);
			$this->setNotifyMessage(NotificationType::Success, 'Your password has been changed successfully');
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
            throw new CHttpException($e);
        }
    }

    public function actionIndex() {
        try {
            $model = new Users('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Users']))
                $model->attributes = $_GET['Users'];
            $model->role_id = ROLE_MEMBER;
            $this->render('index', array(
                'model' => $model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException($e);
        }
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = 'UpdateAgentBE';
        $old_temp_pass = $model->temp_password;
        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $model->last_update_date = date('Y-m-d H:i:s');

            if($_POST['Users']['temp_password']=='' && $_POST['Users']['password_confirm']=='')
            {
                $model->temp_password = $old_temp_pass;
                $model->password_confirm = $old_temp_pass;
            } else if ($_POST['Users']['temp_password'] !='' && $_POST['Users']['password_confirm']!='') {
                $model->temp_password = $_POST['Users']['temp_password'];
                $model->password_confirm = $_POST['Users']['password_confirm'];
            }
            $model->address2 = $_POST['Users']['address2'];
            $model->full_name = $model->first_name. ' ' . $model->last_name;

            if ($model->validate()) 
            {
                $model->password_hash = md5($model->temp_password);                
                $model->save();
                SendEmail::adminChangeUserBE($model);
                /*if($_POST['Users']['temp_password'] !='' && $_POST['Users']['password_confirm']!='') 
                {
                    SendEmail::adminResetPassword($model);
                }*/
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                $this->redirect(array('view', 'id' => $model->id));
            }
            else
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('update', array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->first_name
        ));
    }

    public function actionView($id) {
         try {
            $model = $this->loadModel($id);
            $this->render('view', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->first_name
            ));
         } catch (Exception $exc) {
             throw new CHttpException(404, 'The requested page does not exist.');
         }
    }

    /*
     * Bulk delete
     * If you don't want to delete some specified record please configure it in global $cannotDetele variable
     */

    public function actionDeleteAll() {
        $deleteItems = $_POST['users-grid_c0'];
        $shouldDelete = array_diff($deleteItems, $this->cannotDetele);

        if (!empty($shouldDelete)) {
            Users::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
            $this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
        }
        else
            $this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function loadModel($id) {
        //need this define for inherit model case. Form will render parent model name in control if we don't have this line
        $initMode = new Users();
        $model = $initMode->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}