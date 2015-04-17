<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
?>
<?php echo "<?php\n"; ?>

/**
 * This is the model class for table "<?php echo $tableName; ?>".
 *
 * The followings are the available columns in table '<?php echo $tableName; ?>':
<?php foreach($columns as $column): ?>
 * @property <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
<?php if(!empty($relations)): ?>
 *
 * The followings are the available model relations:
<?php foreach($relations as $name=>$relation): ?>
 * @property <?php
	if (preg_match("~^array\(self::([^,]+), '([^']+)', '([^']+)'\)$~", $relation, $matches))
    {
        $relationType = $matches[1];
        $relationModel = $matches[2];

        switch($relationType){
            case 'HAS_ONE':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'BELONGS_TO':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'HAS_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            case 'MANY_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            default:
                echo 'mixed $'.$name."\n";
        }
	}
    ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?php echo $modelClass; ?> extends _BaseModel <?php echo "\n"; ?>
{
	<?php 
	if (isset($customConfigs['ModelCodeImage']))
	{
		echo "\n";
		echo "\t".'public $maxImageFileSize = 3145728; //3MB' . "\n";
		echo "\t"."public \$allowImageType = 'jpg,gif,png';" . "\n";
		echo "\t"."public \$uploadImageFolder = 'upload/images'; //remember remove ending slash\n";
		echo "\t"."public \$defineImageSize = array(\n";
		$i = 1;
		foreach($customConfigs['ModelCodeImage'] as $item)
		{
			echo "\t\t\t'$item' => array(
				array('alias' => '100x100', 'size' => '100x100'),
				//array('alias' => 'SIZE_IN_LOCAL_CONFIG', 'size' => 'SIZE_IN_LOCAL_CONFIG'),
			), \n";
		}
		echo "\t);";
	}?>
	
	<?php 
	if (isset($customConfigs['ModelCodeFile']))
	{
		echo 'public $maxUploadFileSize = 3145728; //3MB' . "\n";
		echo "public \$allowUploadType = 'doc,docx,xls,xlsx,pdf'\n";
		echo "public \$uploadFileFolder = '/upload/files'; //remember remove ending slash\n";
		echo "public \$uploadFileFields = array('" . implode("', '", $customConfigs['ModelCodeFile']) . "')\n";
		
		echo "\t);";
	}?>
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '<?php echo $tableName; ?>';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
<?php foreach($rules as $rule): ?>
			<?php echo $rule.",\n"; ?>
<?php endforeach; ?>
<?php 
			$required ='';
			if (isset($customConfigs['ModelCodeRequired']))
			{
				$required = implode(',', $customConfigs['ModelCodeRequired']);
				echo "\t\t array('$required', 'required', 'on' => 'create, update'), \n";
			}
			
			$email ='';
			if (isset($customConfigs['ModelCodeEmail']))
			{
				$email = implode(',', $customConfigs['ModelCodeEmail']);
				echo "\t\t array('$email', 'email', 'on' => 'create, update'), \n";
			}
			
			$unique ='';
			if (isset($customConfigs['ModelCodeUnique']))
			{
				$unique = implode(',', $customConfigs['ModelCodeUnique']);
				echo "\t\t array('$unique', 'unique', 'on' => 'create, update'), \n";
			}
			
			$image ='';
			if (isset($customConfigs['ModelCodeImage']))
			{
				$image = implode(',', $customConfigs['ModelCodeImage']);
				echo "\t\t 
					array('$image', 'file', 'on' => 'create,update',
						'allowEmpty' => true,
						'types' => \$this->allowImageType,
						'wrongType' => 'Only ' . \$this->allowImageType . ' are allowed.',
						'maxSize' => \$this->maxImageFileSize, // 3MB
						'tooLarge' => 'The file was larger than' . (\$this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
					), \n";
				
			}
			
			$file ='';
			if (isset($customConfigs['ModelCodeUploadfile']))
			{
				$file = implode(',', $customConfigs['ModelCodeUploadfile']);
				echo "\t\t 
					array('$file', 'file', 'on' => 'create,update',
						'allowEmpty' => true,
						'types' => \$this->allowUploadType,
						'wrongType' => 'Only ' . \$this->allowUploadType . ' are allowed.',
						'maxSize' => \$this->maxUploadFileSize, // 3MB
						'tooLarge' => 'The file was larger than ' . (\$this->maxUploadFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
					), \n";

			}
			
			
?>
			array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
<?php foreach($relations as $name=>$relation): ?>
			<?php echo "'$name' => $relation,\n"; ?>
<?php endforeach; ?>
	
<?php 
if (isset($customConfigs['relationTable'])):
	$i = 1;
	foreach($customConfigs['relationTable'] as $name): ?>
				<?php if($name != '' && isset($customConfigs['relationName'][$i]) && isset($customConfigs['relationField'][$i])): ?>
				<?php echo "'" .  $model->generateClassName($name) . "' => array(self::" . $customConfigs['relationName'][$i] . ", '" . $model->generateClassName($name) . "', '" . $customConfigs['relationField'][$i] . "'),\n"; ?>
	<?php 
				endif;
	$i++;
	endforeach; 
endif;
?>
		);
	}

	public function attributeLabels()
	{
		return array(
<?php foreach($labels as $name=>$label): ?>
			<?php echo "'$name' => Yii::t('translation','$label'),\n"; ?>
<?php endforeach; ?>
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

<?php
$hasStatus = false;
foreach($columns as $name=>$column)
{
	if ($name == 'status')
		$hasStatus = true;
	if($column->type==='string')
	{
		echo "\t\t\$criteria->compare('$name',\$this->$name,true);\n";
	}
	else
	{
		echo "\t\t\$criteria->compare('$name',\$this->$name);\n";
	}
}
?>
		<?php 
		//for default sort field
		if (isset($customConfigs['sortfield']) && $customConfigs['sortfield'] != ''):?>
		$sort = new CSort();

        $sort->attributes = array(
            'name' => array(
                'asc' => 't.<?php echo $customConfigs['sortfield'];?>',
                'desc' => 't.<?php echo $customConfigs['sortfield'];?> desc',
                'default' => 'asc',
            ),
        );
		$sort->defaultOrder = 't.<?php echo $customConfigs['sortfield'];?> asc';
		<?php
		endif;
		?>
			
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

<?php if($connectionId!='db'):?>
	
	public function getDbConnection()
	{
		return Yii::app()-><?php echo $connectionId ?>;
	}

<?php endif?>
	
<?php if ($hasStatus): ?>
	public function activate()
    {
        $this->status = 1;
        $this->update();
    }



    public function deactivate()
    {
        $this->status = 0;
        $this->update();
    }
<?php endif; ?>
<?php if (isset($customConfigs['slugfield']) && $customConfigs['slugfield'] != ''):?>
	public function behaviors() {
        return array('sluggable' => array(
                'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('<?php echo $customConfigs['slugfield'];?>'),
                'unique' => true,
                'update' => true,
            ),);
    }
	
	public static function getDetailBySlug($slug)
	{
		$criteria = new CDbCriteria;
        $criteria->compare('t.slug', $slug);
        return self::model()->find($criteria);
	}
	
<?php endif;?>

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}
	public static function getListData()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return  array(''=>'---Chọn---') + CHtml::listData($models,'id','name');
	}
	protected function beforeSave() 
	{
		/*
		if(empty($this->created_date))
		{
			$this->created_date = date('Y-m-d H:i:s');
		}
        $this->updated_date = date('Y-m-d H:i:s');
        */
	    return parent::beforeSave();
	}
}
