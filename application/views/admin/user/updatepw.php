<div class="content">
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<form method="post" name="userEdit" action="<?php echo $action; ?>">
		<div class="data">
		<table>	
			<tr style = "display: none">
				<td>ID</td>
				<td><input type="text" name="id" disabled="disable" class="text" value="<?php echo set_value('id'); ?>"/></td>
				<input type="hidden" name="id" value="<?php echo set_value('id',$this->session->userdata('id')); ?>"/>
			</tr>		
			<tr>
				<td width="30%" valign="top">Name</td>
				<td><input type="text" name="name" disabled="disable" class="text" value="<?php echo set_value('name',$this->session->userdata('name')); ?>"/>
				<input type="hidden" name="name" value="<?php echo set_value('name',$this->session->userdata('name')); ?>"/>	
					<?php echo form_error('name'); ?></td>
				</td>
			</tr>	
			<tr>
				<td valign="top">New Password</td>
				<td><input type="password" name="password" class="text" />
					<?php echo form_error('password'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Repeat Password</td>
				<td><input type="password" name="pass_conf" class="text" />
					<?php echo form_error('pass_conf'); ?>
				</td>				
			</tr>
			
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		</div>
		</form>
		<br />
	</div>	