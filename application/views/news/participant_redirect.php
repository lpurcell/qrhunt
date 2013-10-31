<h2><?php echo $error ?></h2>

<?php $this->output->set_header('refresh:3;url ='.site_url('participant_edit/'.get_cookie('participant_id'))); ?>