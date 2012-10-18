<div id="content">
	<div class="ui-control scroll-pane">
		<div class="main">
			
			<h1>Users</h1>
			<p>Below is a list of the users.</p>

			<div id="infoMessage"><?php echo $message;?></div>

			<table id="users" class="table table-hover">
				<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Groups</th>
					<th>Status</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($users as $user):?>
					<tr>
						<td><?php echo $user->first_name;?></td>
						<td><?php echo $user->last_name;?></td>
						<td><?php echo $user->email;?></td>
						<td>
							<?php foreach ($user->groups as $group):?>
								<?php echo $group->name;?><br />
			                <?php endforeach?>
						</td>
						<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Active') : anchor("auth/activate/". $user->id, 'Inactive');?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
<br /><div class="clearfix"></div>
			<a class="btn btn-mini" href="<?php echo site_url('app/users/create_user');?>">Create a new user</a>
			
		</div>
	</div>
</div>