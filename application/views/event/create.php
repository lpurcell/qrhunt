<div class="event">

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('admin/event/create') ?>
<h2>Register your Event</h2>
<label for="Organization_ID">Choose your Organization:</label>
<select name="Organization_ID">
    <?php foreach($organization as $organization_item): ?>
        <option  value="<?php echo $organization_item->Organization_ID; ?>"><?php echo $organization_item->Organization_Name; ?></option>
    <?php endforeach ?>
</select><br />

<label for="Event_Name">Event Name:</label>
<input type="input" name="Event_Name" value="<?php echo set_value('Event_Name')?>"/><br />

<label for="Event_Location">Location:</label>
<input type="text" name="Event_Location" value="<?php echo set_value('Event_Location')?>"/><br />

<label for="Event_Date">Date:</label>
<input type="input" id="datepicker" name="Event_Date" value="<?php echo set_value('Event_Date')?>"/><br />

<label for="Event_Coordinator">Coordinator Name:</label>
<input type="input" name="Event_Coordinator" value="<?php echo set_value('Event_Coordinator')?>"/><br />

<label for="Event_Email">Coordinator Email:</label>
<input type="input" name="Event_Email" value="<?php echo set_value('Event_Email')?>"/><br />

<label for="Event_Logo">Event Logo:</label>
<input type="file" name="userfile" value="<?php echo set_value('userfile')?>"/><br />

<div id=>
    <label for="Event_Maincolor">Main Color:</label>
    <input type="minicolors_main"  name="Event_Maincolor" value="<?php echo set_value('Event_Maincolor')?>"/><br />
</div>

<label for="Event_Textcolor">Text Color:</label>
<input type="minicolors_text" id="minicolors" name="Event_Textcolor" value="<?php echo set_value('Event_Textcolor')?>"/><br />

<label for="Event_Headercolor">Header Color:</label>
<input type="minicolors_header" name="Event_Headercolor" value="<?php echo set_value('Event_Headercolor')?>"/><br />

<input type="submit" name="submit" value="Register Your Event" />

</form></div>