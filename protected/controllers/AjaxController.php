<?php
class AjaxController extends FrontController 
{
	public function actionGetSubMenuCategory()
	{
		if(isset($_POST['parent_id']))
		{
			$parent_id = $_POST['parent_id'];
			$criteria = new CDbCriteria();
			$criteria->compare('t.status',STATUS_ACTIVE);
			$criteria->compare('t.parent_id', $parent_id);
			$criteria->order ="order_display DESC, id DESC";
			$models = CategoryTin::model()->findAll($criteria);
			$html = '';
			if(!empty($models))
			{
				$html .='<select class="form-control" name="ThoiSu[category_sub_id]" id="ThoiSu_category_sub_id">';
				foreach ($models as $one) 
				{
					if(empty($one)) continue;
					$html .= '<option value="'.$one->id.'">'.$one->name.'</option>';
				}
				$html .='</select>';
			}
			if($html!='')
				echo $html;
			die;
		}
	}

}
