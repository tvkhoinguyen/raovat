<?php

class ControlleradminCode extends CCodeModel
{

	public $controller;
	public $baseClass = 'AdminController';
	public $actions = 'index';
	public $model_name;
	public $type_option;
	private $_modelClass;
	private $_table;

	public function rules()
	{
		return array_merge(parent::rules(), array(
			array('controller, actions, baseClass, model_name', 'filter', 'filter' => 'trim'),
			array('controller, baseClass, model_name', 'required'),
			array('type_option', 'safe'),
			array('controller', 'match', 'pattern' => '/^\w+[\w+\\/]*$/', 'message' => '{attribute} should only contain word characters and slashes.'),
			array('actions', 'match', 'pattern' => '/^\w+[\w\s,]*$/', 'message' => '{attribute} should only contain word characters, spaces and commas.'),
			array('baseClass', 'match', 'pattern' => '/^[a-zA-Z_]\w*$/', 'message' => '{attribute} should only contain word characters.'),
			array('baseClass', 'validateReservedWord', 'skipOnError' => true),
			array('baseClass, actions', 'sticky'),
			array('model_name', 'validateModel'),
		));
	}

	public function validateModel($attribute, $params)
	{
		if ($this->hasErrors('model_name'))
			return;
		$class = @Yii::import($this->model_name, true);
		if (!is_string($class) || !$this->classExists($class))
			$this->addError('model_name', "Class '{$this->model_name}' does not exist or has syntax error.");
		else if (!is_subclass_of($class, 'CActiveRecord'))
			$this->addError('model_name', "'{$this->model_name}' must extend from CActiveRecord.");
		else
		{
			$table = CActiveRecord::model($class)->tableSchema;
			if ($table->primaryKey === null)
				$this->addError('model', "Table '{$table->name}' does not have a primary key.");
			else if (is_array($table->primaryKey))
				$this->addError('model', "Table '{$table->name}' has a composite primary key which is not supported by crud generator.");
			else
			{
				$this->_modelClass = $class;
				$this->_table = $table;
			}
		}
	}

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			'baseClass' => 'Base Class',
			'controller' => 'Controller ID',
			'actions' => 'Action IDs',
			'model_name' => 'Model',
		));
	}

	public function requiredTemplates()
	{
		return array(
			'controller.php',
			'view.php',
		);
	}

	public function successMessage()
	{
		$link = CHtml::link('try it now', Yii::app()->createUrl($this->controller), array('target' => '_blank'));
		unset(Yii::app()->session['type_option']);
		return "The controller has been generated successfully. You may $link.";
	}

	public function prepare()
	{
		$this->files = array();
		$templatePath = $this->templatePath;
                //var_dump($this->type_option['index']); die;
		if (!isset(Yii::app()->session['type_option']))
		{
			Yii::app()->session['type_option'] = $this->type_option;
		}
		if (isset($_POST['ControlleradminCode']))
		{
			$this->type_option = Yii::app()->session['type_option'];
		}

		$class = @Yii::import($this->model_name, true);
		$table = CActiveRecord::model($class)->tableSchema;
		$flag = false;
		$title_name = '';
		foreach ($table->columns as $key => $val)
		{
			if ($table->columns[$key]->name == 'image')
			{
				$flag = true;
			}			
		}
                foreach ($table->columns as $key2 => $val2) {
                    if ($table->columns[$key2]->name == 'name') {
                            $title_name = 'name';
                            break;
                    } elseif ($table->columns[$key2]->name == 'title') {
                            $title_name = 'title';
                            break;
                    } else {
                            $title_name = 'id';
                    }
                }
		/*if ($flag == true)
		{
			$this->files[] = new CCodeFile(
				$this->controllerFile, $this->render($templatePath . '/controller_image.php', array('model_name' => $this->model_name, 'title_name' => $title_name))
			);
		}
		else
		{*/
			$this->files[] = new CCodeFile(
				$this->controllerFile, $this->render($templatePath . '/controller.php', array('model_name' => $this->model_name, 'title_name' => $title_name, 'type_option' => $this->type_option))
			);
		//}

		foreach ($this->getActionIDs() as $action)
		{
			if ($action == "delete")
				continue;
			if ($action == "index")
			{
				$filename = 'index.php';
			}
			elseif ($action == "_search")
			{
				$filename = '_search.php';
			}
			elseif ($action == 'create')
			{
				$filename = 'create.php';
			}
			elseif ($action == 'update')
			{
				$filename = 'update.php';
			}
			elseif ($action == '_form')
			{
				$filename = '_form.php';
			}
			elseif ($action == 'view')
			{
				$filename = 'view.php';
			}
			else
			{
				$filename = 'view_other.php';
			}
			$this->files[] = new CCodeFile(
				$this->getViewFile($action), $this->render($templatePath . '/' . $filename, array('action' => $action, 'type_option' => $this->type_option))
			);
		}
	}

	public function getActionIDs()
	{
		$actions = preg_split('/[\s,]+/', $this->actions, -1, PREG_SPLIT_NO_EMPTY);
		$actions = array_unique($actions);
		sort($actions);
		return $actions;
	}

	public function getControllerClass()
	{
		if (($pos = strrpos($this->controller, '/')) !== false)
			return ucfirst(substr($this->controller, $pos + 1)) . 'Controller';
		else
			return ucfirst($this->controller) . 'Controller';
	}

	public function getModule()
	{
		if (($pos = strpos($this->controller, '/')) !== false)
		{
			$id = substr($this->controller, 0, $pos);
			if (($module = Yii::app()->getModule($id)) !== null)
				return $module;
		}
		return Yii::app();
	}

	public function getControllerID()
	{
		if ($this->getModule() !== Yii::app())
			$id = substr($this->controller, strpos($this->controller, '/') + 1);
		else
			$id = $this->controller;
		if (($pos = strrpos($id, '/')) !== false)
			$id[$pos + 1] = strtolower($id[$pos + 1]);
		else
			$id[0] = strtolower($id[0]);
		return $id;
	}

	public function getUniqueControllerID()
	{
		$id = $this->controller;
		if (($pos = strrpos($id, '/')) !== false)
			$id[$pos + 1] = strtolower($id[$pos + 1]);
		else
			$id[0] = strtolower($id[0]);
		return $id;
	}

	public function getControllerFile()
	{
		$module = $this->getModule();
		$id = $this->getControllerID();
		if (($pos = strrpos($id, '/')) !== false)
			$id[$pos + 1] = strtoupper($id[$pos + 1]);
		else
			$id[0] = strtoupper($id[0]);
		return $module->getControllerPath() . '/' . $id . 'Controller.php';
	}

	public function getViewFile($action)
	{
		$module = $this->getModule();
		return $module->getViewPath() . '/' . $this->getControllerID() . '/' . $action . '.php';
	}

}
