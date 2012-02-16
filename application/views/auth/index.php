<div class='mainInfo'>

	<h1>Users</h1>
	<p>Below is a list of the users.</p>
	
	<div id="infoMessage"><?php echo $message;?></div>
	
	<table cellpadding=0 cellspacing=10>
		<tr>
            <th>Username</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>

			<th>Status</th>
		</tr>
		<?php foreach ($users as $user):?>
			<tr>
                <td><?php echo $user->username;?></td>
				<td><?php echo $user->first_name;?></td>
				<td><?php echo $user->last_name;?></td>
				<td><?php echo $user->email;?></td>

				<td>
					<?php foreach ($user->groups as $group):?>
						<?php echo $group->name;?><br />
	                <?php endforeach?>
				</td>
				<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Active') : anchor("auth/activate/". $user->id, 'Inactive');?></td>
                <td><?php echo  anchor("auth/deactivate/".$user->id, 'Modificar') ;?></td>
			</tr>
		<?php endforeach;?>
	</table>
	
	<p><a href="<?php echo site_url('auth/create_user');?>">Create a new user</a></p>

    <?php echo anchor('claves/claves_usuarios','catalogo de claves');?>
<p>
    <?php echo anchor('auth/logout','logout');?>
</p>

	
</div>
