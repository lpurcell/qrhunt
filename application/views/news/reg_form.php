<h2>Register your Profile</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('register/regform') ?>

    <label for="Event">Event:</label>
    <input type="input" name="Event" /><br />

	<label for="Participant_LName">Last Name:</label> 
	<input type="input" name="Participant_LName" /><br />

	<label for="Participant_FName">First Name:</label> 
	<input type="input" name="Participant_FName" /><br />

	<label for="Participant_Email">Email:</label> 
	<input type="input" name="Participant_Email" /><br />

	<label for="QRCode">QRCode:</label>
	<input type="input" name="QRCode" /><br />

	<label for="MISC1">Misc 1:</label>
	<input type="input" name="MISC1" /><br />

    <label for="MISC2">Misc 2:</label>
    <input type="input" name="MISC2" /><br />

    <label for="MISC3">Misc 3:</label>
    <input type="input" name="MISC3" /><br />

	<label for="Participant_Picture">Picture:</label> 
	<input type="input" name="Participant_Picture" /><br />

	<input type="submit" name="submit" value="Register Your Profile" /> 

</form>