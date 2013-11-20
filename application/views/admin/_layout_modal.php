<?php $this->load->view('admin/components/page_header'); ?>

<body style="background: #555;">

	<div class="modal show" role="dialog">
		
<?php $this->load->view($subview); // Subview is set in controller ?>

		<div class="modal-footer">
			&copy; <?php echo date('Y'); ?>
		</div>
	</div>

<?php $this->load->view('admin/components/page_footer'); ?>