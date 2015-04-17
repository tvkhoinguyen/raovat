<?php
	$arr = explode('?v=', $data->link);
	$temp = '//www.youtube.com/embed/'.$arr[1];
?>
<br/>
<iframe width="800" height="600" src="<?php echo $temp; ?>" frameborder="0" allowfullscreen></iframe>
<br/>