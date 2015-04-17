<?php

class ModelGenerator extends CCodeGenerator
{
	public $codeModel='gii.generators.model.ModelCode';

	/**
	 * Provides autocomplete table names
	 * @param string $db the database connection component id
	 * @return string the json array of tablenames that contains the entered term $q
	 */
	public function actionGetTableNames($db)
	{
		if(Yii::app()->getRequest()->getIsAjaxRequest())
		{
			$all = array();
			if(!empty($db) && Yii::app()->hasComponent($db)!==false && (Yii::app()->getComponent($db) instanceof CDbConnection))
				$all=array_keys(Yii::app()->{$db}->schema->getTables());

			echo json_encode($all);
		}
		else
			throw new CHttpException(404,'The requested page does not exist.');
	}
	
	//Austin add more code
	public function actionGetTableColunmConfig()
	{
		$tableName = $_POST["tablename"];
		$selectedfield = $_POST['selectedfield'];
		$option = "<option value=''>Doesn't has</option>";
		$model=$this->prepare();
		if($tableName != '')
		{
			$columns = $model->getTableSchema($tableName);
			foreach ($columns->columns as $column)
			{
				$selected = '';
				if (strpos($selectedfield, $column->name.',') !== false)
				{
					$selectedfield = str_replace($column->name, '', $selectedfield);
					$selected = " selected ";
				}
				$option .= '<option ' . $selected . ' value="' . $column->name . '">' . $column->name . '</option>';
			}
		}
		echo $option;
	}
	
	public function actionIndex()
	{
		$columns = array();
		$model=$this->prepare();
		if($model->files!=array() && isset($_POST['generate'], $_POST['answers']))
		{
			$model->answers=$_POST['answers'];
			$model->status=$model->save() ? CCodeModel::STATUS_SUCCESS : CCodeModel::STATUS_ERROR;
		}

		if ($model->tableName)
			$columns = $model->getTableSchema($model->tableName);
		
		$this->render('index',array(
			'model'=>$model, 'columns' => $columns
		));
	}
}