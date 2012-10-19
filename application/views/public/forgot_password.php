<div class="container">
	<div class="columns offset-by-five six row">
		<div class="login">
			<?php if($message): ?>
			<div class="alert">
			  <button type="button" class="close" data-dismiss="alert">×</button>
			  <?php echo $message;?>
			</div>
			<?php endif; ?>
		<?php echo form_open("app/forgot_password");?>
				<h4 style="text-align:right;">Forgot Password</h4>
				<p style="font-size:11px;padding:10px 0">
					Please enter your email address so we can send you an email to reset your password.</p>
				
				<div class="clearfix"></div>
				<div class="control-group">
			    <label class="control-label" for="inputEmail">Email</label>
			    <div class="controls">
			      <?php echo form_input($email);?>
			    </div>
			  </div>
		    <div class="control-group">
			    <div class="controls">
		<!--<label class="checkbox"><?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>Remember me</label><br />-->
			      <?php echo form_submit('submit', 'Submit', 'class="btn"');?>&nbsp;&nbsp;<small>or go back to <a href="<?= site_url(); ?>/app/login"><strong>login</strong></a></small>
			    </div>
			  </div>
		<?php echo form_close();?>
</div></div></div>