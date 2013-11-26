<div class="content">
		<h1>Users</h1>
		<div class="paging"><?php echo $pagination; ?></div>
		<div class="data"><?php echo $table; ?></div>
		<br />
		<?php echo $link_dashboard; ?>
		<?php echo anchor('admin/user/add/','add new user',array('class'=>'add')); ?>		
</div>