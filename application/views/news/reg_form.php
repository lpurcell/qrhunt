<h2>Register your Profile</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('register/regform') ?>

    <label for="Event">Event:</label>
    <input type="input" name="Event" /><br />

	<label for="Participant_LName">Last Name:</label> 
	<input type="input" name="Participant_LName" /><br />

	<label for="Participant_FName">First Name:</label> 
	<input type="input" name="Participant_FName" /><br />

	<label for="Group">Group:</label>
	<input type="input" name="Group" /><br />

	<label for="QRCode">QRCode:</label>
	<input type="input" name="QRCode" /><br />

	<label for="Major">Major:</label>
	<input type="input" name="Major" /><br />

	<label for="Participant_Picture">Picture:</label> 
	<input type="input" name="Participant_Picture" /><br />

	<input type="submit" name="submit" value="Register Your Profile" /> 

</form>