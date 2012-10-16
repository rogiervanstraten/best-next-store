<div class="ui-login-nav">
	<ul class="ui-nav">
		<li><a href="#">About</a></li>
		<li><a href="#">Sign up</a></li>
		
	</ul>
</div>
<div class="container">
	<div class="columns offset-by-five six row">
		<div class="login">
			<?php if($message): ?>
			<div class="alert">
			  <button type="button" class="close" data-dismiss="alert">×</button>
			  <?php echo $message;?>
			</div>
			<?php endif; ?>
		<?php echo form_open("app/login");?>
				<a class="ui-logo" href="#" title="Smarten UP">Smarten Up</a>
				<div class="clearfix"></div>
				<div class="control-group">
			    <label class="control-label" for="inputEmail">Email</label>
			    <div class="controls">
			      <?php echo form_input($identity);?>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputPassword">Password</label>
			    <div class="controls">
				    <?php echo form_input($password);?>
						<span class="help-block">
							<a class="forgotten" href="<?= site_url(); ?>/app/forgot_password"><small>Forgot your password?</small></a>
						</span>
			    </div>
			  </div>
		    <div class="control-group">
			    <div class="controls">
		<!--<label class="checkbox"><?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>Remember me</label><br />-->
			      <?php echo form_submit('submit', 'Login', 'class="btn"');?>
			    </div>
			  </div>
		<?php echo form_close();?>
</div></div></div>