<div class="bannerhome">
	<?php
	$listbanner = Banner::findHomeActiveBanner();
	if(!empty($listbanner))
	{
		echo '<ul class="bxslider clearfix">';
		foreach ($listbanner as $one) 
		{
			if( empty($one)) continue;
			?>
				<li><img src="<?php echo ImageHelper::getImageUrl($one, "image", Banner::HOME_BANNER_SIZE1); ?>" alt="<?php echo $one->content; ?>" title="<?php echo $one->content; ?>" /></li>
			<?php
		}
		echo '</ul>';
	}
	?>
</div>