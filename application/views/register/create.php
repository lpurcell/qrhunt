<h2>Register your Profile</h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('register/create') ?>

<!--HARDCODED--> <input type ="hidden" name="Event_ID" value='123'>

	<label for="Participant_LName">Last Name:</label> 
	<input type="text" name="Participant_LName" /><br />

	<label for="Participant_FName">First Name:</label> 
	<input type="input" name="Participant_FName" /><br />

	<label for="Participant_Email">Email:</label> 
	<input type="input" name="Participant_Email" /><br />

	<label for="QRCode">QRCode:</label>
	<input type="input" name="QRCode" /><br />

	<label for="Participant_Website">Personal Website:</label> 
	<input type="input" name="Participant_Website" /><br />

	<label for="Participant_Picture">Picture:</label> 
	<input type="file" name="userfile" /><br />

	<input type="submit" name="submit" value="Register Your Profile" /> 

</form>