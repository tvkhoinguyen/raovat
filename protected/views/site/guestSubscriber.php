<div class="title-1 clearfix">
	<h1>Newsletter</h1>
</div>
<div class="newsletter">
	<p class="type">I would like to be contacted by Ed Et Al with regards to information on Ed Et Al's news <br/> and products by e-mail and receive its newsletter.</p>
	<div class="form-type clearfix">
		<input type="text" class="form-control" />
		<?php if(isset($error['not_valid'])): ?>
			<div style="height: 100px;background-color: #BD3970;"><h2 style="padding-top: 40px;">Email: <?php echo $email;?>  not valid !</h2></div>
		<?php elseif(isset($error['exists'])): ?>
			<div style="height: 100px;background-color: #BD3970;"><h2 style="padding-top: 40px;">Email: <?php echo $email;?>  had existed!</h2></div>
		<?php else: ?>
			<div style="height: 100px;background-color: #BD3970;"><h2 style="padding-top: 40px;">Email: <?php echo $email;?>  successful subscriber!</h2></div>
		<?php endif;?>
		<button type="submit" class="btn-1 btn-small">Ok</button>
	</div>
</div>