<?php

class PagesController extends AdminController {

    public $pluralTitle = 'List Pages';
    public $singleTitle = 'Page';
    public $cannotDetele = array();

    public function actionCreate() {
        try {
            $model = new Page('create');
            $model->display_order = $model->nextOrderNumber();

            if (isset($_POST['Page'])) {
                $model->attributes = $_POST['Page'];
                if ($model->save()) {
//                    $model->saveImage('featured_image');
                    $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('index'));
                } else {
                    $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be create for some reasons');
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
                        //call delete image first
//                        $model->removeImage(array('featured_image'), true);
                        Page::model()->updateAll(array('parent_id' => '0'), 'parent_id = ' . $model->id);
                        if ($model->delete())
                            Yii::log("Delete record " . print_r($model->attributes, true), 'info');
                    }

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                }
            }
            else {
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
            $model = new Page('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Page']))
                $model->attributes = $_GET['Page'];

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
        //var_dump($_POST['Page']);
        if (isset($_POST['Page'])) {
            $model->attributes = $_POST['Page'];

            if ($model->save()) {
//                $model->saveImage('featured_image');
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                $this->redirect(array('index'));
            } else {
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
            }
        }
        //$model->beforeRender();
        $this->render('update', array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->title));
    }

    public function actionView($id) {
        try {
            $model = $this->loadModel($id);
            $this->render('view', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->title));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionDeleteAll() {
        $deleteItems = $_POST['page-grid_c0'];
        $shouldDelete = array_diff($deleteItems, $this->cannotDetele);

        if (!empty($shouldDelete)) {
            Page::model()->updateAll(array('parent_id' => '0'), 'parent_id in (' . implode(',', $shouldDelete) . ')');
            $deleteImages = Page::model()->findAll('id in (' . implode(',', $shouldDelete) . ')');
            if (!empty($deleteImages)) {
                foreach ($deleteImages as $item) {
                    $item->removeImage(array('featured_image'), true);
                }
            }
            Page::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
            $this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
        } else
            $this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function actionRemoveImage($fieldName, $id) {
        try {
            $model = $this->loadModel((int) $id);
            $model->removeImage(array($fieldName));
            echo 'thumbnail-' . $id;
        } catch (Exception $exc) {
            echo '';
        }
    }

    public function loadModel($id) {
        $initModel = new Page();
        $model = $initModel->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
