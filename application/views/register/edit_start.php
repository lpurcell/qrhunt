<h2><?php echo $title ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open('participant/edit_start') ?>

<label for="QRCode">QRCode: </label>
<input type="input" name="QRCode" /><br />

<input type="submit" name="submit" value="Add Participant" /><br />
