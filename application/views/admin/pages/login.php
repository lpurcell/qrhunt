<div class="content">
	<h1><?php echo $title; ?></h1>
    <div class="participants">
	<?=form_open(site_url()."/admin/login")?>
	
	<table cellspacing="3" cellpadding="3">
		
		<tr><td>
			Username or Email <td>
			<?=form_input(array("name"=>"tf_account", "size" => 60, "value"=>set_value("tf_account")))?>
			<td>
			<?=form_error("tf_account")?>
			</tr></td>
	
	 	<tr><td>
			Password <td>
			<?=form_password(array("name"=>"tf_password", "size" => 60))?>
			<td>
			<?php
				if( $this->session->flashdata("pw_error") ) { //Email exist, incorrect password returned error.
					echo $this->session->flashdata("pw_error"); //Returns Controller Error.
				} else {
					echo form_error("tf_password");
				}
			?>
		</tr></td>
	
		<tr><td><td><?php echo form_submit('submit', 'Log in', 'class="btn btn-primary"'); ?></td>
	</table>
	
	 <?=form_close()?>
 </div>