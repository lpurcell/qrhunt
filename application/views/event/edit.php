<h2>Edit Event</h2>

<?php echo validation_errors(); ?>

<p>
    <?php if ($Event->Event_Logo === "0" || $Event->Event_Logo === ""){ ?>
        <img src="<?php echo base_url(); ?>assets/images/default_logo.jpg">
    <?php }else{ ?>
        <img src= "<?= base_url();?>uploads/<?= $Event->Event_Logo ?>">
    <?php } ?>
</p>
<?php echo form_open_multipart('event_edit/'.$Event->Event_ID) ?>

<input type ="hidden" name="EVENT_ID" value="<?php echo $Event->Event_ID ?>">

<label for="Organization_ID">Choose your Organization:</label>

<select name="Organization_ID">
    <?php foreach($organization as $organization_item): ?>
        <option  value="<?php echo $organization_item->Organization_ID; ?>" <?php if ($organization_item->Organization_ID == $Event->Organization_ID){ echo "selected='selected'"; }else{ ''; } ?> ><?php echo $organization_item->Organization_Name; ?></option>
    <?php endforeach ?>
</select><br />

<label for="Event_Name">Event Name:</label>
<input type="input" name="Event_Name" value="<?php echo $Event->Event_Name ?>"><br />

<label for="Event_Location">Location:</label>
<input type="text" name="Event_Location" value="<?php echo $Event->Event_Location ?>"><br />

<label for="Event_Date">Date:</label>
<input type="input" id="datepicker" name="Event_Date" value="<?php echo $Event->Event_Date ?>"><br />

<label for="Event_Coordinator">Coordinator Name:</label>
<input type="input" name="Event_Coordinator" value="<?php echo $Event->Event_Coordinator ?>"><br />

<label for="Event_Email">Coordinator Email:</label>
<input type="input" name="Event_Email" value="<?php echo $Event->Event_Email ?>"><br />

<label for="Event_Logo">Event Logo:</label>
<input type="file" name="userfile" value="<?php echo $Event->Event_Logo ?>"><br />

 <label for="Event_Maincolor">Main Color:</label>
 <input type="minicolors_main"  name="Event_Maincolor" value="<?php echo $Event->Event_Maincolor ?>"><br />


<label for="Event_Textcolor">Text Color:</label>
<input type="minicolors_text" id="minicolors" name="Event_Textcolor" value="<?php echo $Event->Event_Textcolor ?>"><br />

<label for="Event_Headercolor">Header Color:</label>
<input type="minicolors_header" name="Event_Headercolor" value="<?php echo $Event->Event_Headercolor ?>"><br />

<input type="submit" name="submit" value="Edit Your Event" />

</form>