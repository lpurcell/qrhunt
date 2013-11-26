
	<div class="content">
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr style = "display: none">
				<td>ID</td>
				<td><?php echo $user->id; ?></td>
			</tr>
			<tr>
				<td width="30%" valign="top">Name: <?php echo $user->name; ?></td>
				<td>User E-Mail: <?php echo $user->email; ?></td>
				<td>UserName: <?php echo $user->username; ?></td>
		</table>
		</div>
		<br />
		<?php echo $link_dashboard; ?>
		<?php echo $link_back; ?>
	</div>
