<h2>Register your Organization</h2>
<?php echo validation_errors(); ?>

<?php echo form_open('organization/create') ?>

<label for="Organization_Name">Organization Name:</label>
<input type="input" name="Organization_Name" value="<?php echo set_value('Organization_Name')?>"/><br />

<label for="Organization_Sponsor">Sponsor Name: </label>
<input type="input" name="Organization_Sponsor" value="<?php echo set_value('Organization_Sponsor')?>"/><br />

<input type="submit" name="submit" value="Register Your Organization" /><br />