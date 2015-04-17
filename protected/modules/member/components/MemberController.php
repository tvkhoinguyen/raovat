<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class MemberController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/site';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

        public function init(){
            parent::init();
        }
	
	/**
     * Handle the ajax request. This process changes the status of member to 1 (mean active)
     * @param type $id the id of member need changed status to 1
     */
    public function actionAjaxActivate($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'activate'))
            {
                $model->activate();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Handle the ajax request. This process changes the status of member to 0 (mean deactive)
     * @param type $id the id of member need changed status to 0
     */
    public function actionAjaxDeactivate($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'deactivate'))
            {
                $model->deactivate();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
    }

    public $_metaKeyword;

    public $_metaDescription;
    
    //public $pageTitle;

    public function getMetaKeywords()
    {
        if(!empty($this->_metaKeyword))
            return $this->_metaKeyword;
        else
        {
            return Yii::app()->params['meta_keywords'];
        }
    }

    public function setMetaKeywords($value)
    {
        $this->_metaKeyword=$value;
    }

    public function getMetaDescription()
    {
        if(!empty($this->_metaDescription))
            return $this->_metaDescription;
        else
        {
            return Yii::app()->params['meta_description'];
        }
    }

    public function setMetaDescription($value)
    {
        $this->_metaDescription=$value;
    }

}