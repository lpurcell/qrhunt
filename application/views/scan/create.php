<h2>Create a Manual Scan</h2>
<?php echo validation_errors(); ?>

<?php echo form_open('scan/create') ?>

<label for="QR_Scanned">QR Scanned: </label>
<input type="input" name="QR_Scanned" /><br />

<input type="submit" name="submit" value="Manual Scan" /><br />
