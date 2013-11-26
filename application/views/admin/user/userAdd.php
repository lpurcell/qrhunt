<div class="content">
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>	
			<tr style = "display: none">
				<td>ID</td>
				<td><input type="text" name="id" disabled="disable" class="text" value="<?php echo set_value('id'); ?>"/></td>
				<input type="hidden" name="id" value="<?php echo set_value('id',$this->form_data->id); ?>"/>
			</tr>		
			<tr>
				<td width="30%" valign="top">Name<span style="color:red;">*</span></td>
				<td><input type="text" name="name" class="text" value="<?php echo set_value('name',$this->form_data->name); ?>"/>
					<?php echo form_error('name'); ?>
				</td>
			</tr>			
			<tr>
				<td valign="top">UserName<span style="color:red;">*</span></td>
				<td><input type="text" name="username" class="text" value="<?php echo set_value('username',$this->form_data->username); ?>"/>
					<?php echo form_error('username'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Password<span style="color:red;">*</span></td>
				<td><input type="password" name="password" class="text"/>
					<?php echo form_error('password'); ?>
				</td>
			</tr>
			<tr>
				<td valign="top">Repeat Password<span style="color:red;">*</span></td>
				<td><input type="password" name="pass_conf" class="text"/>
					<?php echo form_error('pass_conf'); ?>
				</td>
				<td>Force Password Change <input type="checkbox"  name="changePassword" value="1"></td>
			</tr>
			<tr>
				<td valign="top">E-Mail<span style="color:red;">*</span></td>
				<td><input type="text" name="email" class="text" value="<?php echo set_value('email',$this->form_data->email); ?>"/>
					<?php echo form_error('address1'); ?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		</div>
		</form>
		<br />
		<?php echo $link_back; ?>
	</div>