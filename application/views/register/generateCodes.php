<script src="<?php echo base_url()?>assets/js/qrcode_SJIS.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/qrcode.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/generate.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

<h2>How many QR codes would you like to generate?</h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('register/generateCodes') ?>

<!--HARDCODED--> <input type ="hidden" name="Event_ID" value='123'>
<br /><input type="input" name="NoOfCodes" id="NoOfCodes" /><br />
<input type="button" value="Generate" onClick="generateMult();" /><br />
</form><br /><br />

<div id="emptyFormDiv"></div>