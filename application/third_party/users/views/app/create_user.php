<div id="content" class="large">
	<div class="ui-control scroll-pane">
		<div class="main">
			
			<h1>Create User</h1>
			<p>Please enter the users information below.</p>

			<div id="infoMessage"><?php echo $message;?></div>

			<?php echo form_open("app/users/create_user");?>

			      <p>
			            First Name: <br />
			            <?php echo form_input($first_name);?>
			      </p>

			      <p>
			            Last Name: <br />
			            <?php echo form_input($last_name);?>
			      </p>

			      <p>
			            Company Name: <br />
			            <?php echo form_input($company);?>
			      </p>

			      <p>
			            Email: <br />
			            <?php echo form_input($email);?>
			      </p>

			      <p>
			            Phone: <br />
			            <?php echo form_input($phone1);?>
			      </p>

			      <p>
			            Password: <br />
			            <?php echo form_input($password);?>
			      </p>

			      <p>
			            Confirm Password: <br />
			            <?php echo form_input($password_confirm);?>
			      </p>


			      <p><?php echo form_submit('submit', 'Create User', 'class="btn"');?></p>

			<?php echo form_close();?>
			
		</div>
	</div>
</div>