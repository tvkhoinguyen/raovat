
<?php
//MyDebug::output(Yii::app()->user);
$criteria = new CDbCriteria();
$criteria->compare('t.status',STATUS_NEW);
// $criteria->limit = ;
$criteria->order ="id DESC";
$models = TinRaoVat::model()->count($criteria);
echo '<h1 style="color: red;">Số Tin Cần Duyệt:<font color="red"> <a href="'.Yii::app()->createAbsoluteUrl('admin/tinRaoVat/indexInactive').'">'.$models.' tin</a></font> </h1>';
?>




