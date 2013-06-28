<h2>Register your Event</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('event/create') ?>

<!--HARDCODED--><input type ="hidden" name="Organization_ID" value='456'>

<label for="Event_Name">Event Name:</label>
<input type="input" name="Event_Name" /><br />

<label for="Event_Location">Location:</label>
<input type="text" name="Event_Location" /><br />

<label for="Event_Date">Date:</label>
<input type="input" id="datepicker" name="Event_Date" /><br />

<label for="Event_Coordinator">Coordinator Name:</label>
<input type="input" name="Event_Coordinator" /><br />

<label for="Event_Email">Coordinator Email:</label>
<input type="input" name="Event_Email" /><br />

<label id="fileUpload" for="Event_Logo">Event Logo:</label>
<input type="file" name="userfile" /><br />

<div id=>
<label for="Event_Maincolor">Main Color:</label>
<input type="minicolors_main"  name="Event_Maincolor" /><br />
</div>

<label for="Event_Textcolor">Text Color:</label>
<input type="minicolors_text" id="minicolors" name="Event_Textcolor" /><br />

<label for="Event_Headercolor">Header Color:</label>
<input type="minicolors_header" name="Event_Headercolor" /><br />

<input type="submit" name="submit" value="Register Your Event" />

</form>