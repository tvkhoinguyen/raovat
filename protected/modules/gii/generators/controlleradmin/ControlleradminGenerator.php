<?php

class ControlleradminGenerator extends CCodeGenerator
{

	public $codeModel = 'gii.generators.controlleradmin.ControlleradminCode';
	public function class2id($name)
	{
		return trim(strtolower(str_replace('_','-',preg_replace('/(?<![A-Z])[A-Z]/', '-\0', $name))),'-');
	}
	public function actionGetRelation()
	{
		$this->layout = false;
		$model_name = $_POST['model'];
		$model = new $model_name;
		$relation = $model->relations();
		foreach ($relation as $key => $item)
		{
			$new_model[] = array('model' => $item[1], 'relation' => $key);
		}

		foreach ($new_model as $keyy => $val)
		{
			$class = @Yii::import($val['model'], true);
			$tables = CActiveRecord::model($class)->tableSchema->columns;
			foreach ($tables as $k => $table)
			{
				$result[] = $val['relation'] . ':' . $k;
			}
		}
		echo '<li>';
		echo '<select class="more_attr">';
		foreach ($result as $r)
		{
			$v = explode(':', $r);
			echo '<option value="' . $v[1] . '">' . $r . '</option>';
		}
		$relation_name = explode(':', $result[0]);
		echo '</select>';
		echo '<select class="type_option relation_type">';
		echo '<option value="string">String</option>';
		echo '<option value="number">Number</option>';
		echo '<option value="status">Status</option>';
		echo '<option value="html">Html</option>';
		echo '<option value="date">Date</option>';
		echo '<option value="datetime">Datetime</option>';
		echo '</select>';
		echo '<input type="hidden" class="relation_name" value="' . $relation_name[0] . '" />';
		echo '<span class="del" title="Delete">X</span>';
		echo '<span class="up" title="Move Up">&#8593;</span>';
		echo '<span class="down" title="Move Down">&#8595;</span>';
		echo "</li>";
	}

}
