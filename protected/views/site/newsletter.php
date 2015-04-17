<div class="title-1 clearfix">
	<h1>Newsletter</h1>
</div>
<div class="newsletter">
	<?php
		$content = SmartBlock::model()->findByPk(NEWLETTER_BLOCK);
		echo $content->content;
	?>
	<?php if(!empty($error)): ?>
		<?php if(isset($error['blank'])): ?>
			<div class="errorMessage">Email can not be blank !</div>
		<?php elseif(isset($error['not_valid'])): ?>
			<div class="errorMessage">Email is not valid !</div>
		<?php elseif(isset($error['exists'])): ?>
			<div class="errorMessage">Email had existed!</div>
		<?php elseif(isset($error['success'])): ?>
			<div class="errorMessage">Email successful subscriber!</div>
		<?php endif;?>
	<?php endif;?>
	<div class="form-type clearfix">
            <form method="POST" >
			<input type="text" name="guest_mail" class="form-control" />
			<button type="submit" class="btn-1 btn-small" name="subscribe">Ok</button>
		</form>
	</div>
</div>