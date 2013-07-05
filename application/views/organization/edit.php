<h2>Edit Organization</h2>
<?php echo validation_errors(); ?>

<?php echo form_open('organization_edit/'.$Organization->Organization_ID) ?>

<input type ="hidden" name="Organization_ID" value="<?php echo $Organization->Organization_ID ?>">

<label for="Organization_Name">Organization Name:</label>
<input type="input" name="Organization_Name" value="<?php echo $Organization->Organization_Name ?>"><br />

<label for="Organization_Sponsor">Sponsor Name: </label>
<input type="input" name="Organization_Sponsor" value="<?php echo $Organization->Organization_Sponsor ?>"><br />

<input type="submit" name="submit" value="Edit Your Organization" /><br />
