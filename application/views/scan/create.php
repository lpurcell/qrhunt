

<?php echo validation_errors(); ?>
<Div class="QRmanual">
<?php echo form_open('scan/create') ?>
<h2>Create a Manual Scan</h2>
<label for="QR_Scanned">QR Scanned: </label>
<input type="input" name="QR_Scanned" /><br />

<input type="submit" name="submit" value="Manual Scan" /><br /></div>
