<h2>Edit your Profile</h2>

<?php echo validation_errors(); ?>
<p>
    <?php if ($Participant->Participant_Picture === "0" || $Participant->Participant_Picture === ""){ ?>
        <img src="<?php echo base_url(); ?>assets/images/avatar.jpg">
    <?php }else{ ?>
        <img src= "<?= base_url();?>uploads/<?= $Participant->Participant_Picture ?>">
    <?php } ?>
</p>
<?php echo form_open_multipart('participant_edit/'.$Participant->Participant_ID) ?>

<input type ="hidden" name="Event_ID" value="<?php echo $Participant->Event_ID ?>">
<input type ="hidden" name="Participant_ID" value="<?php echo $Participant->Participant_ID ?>">

<label for="Participant_LName">Last Name:</label>
<input type="text" name="Participant_LName" value="<?php echo $Participant->Participant_LName ?>"/><br />

<label for="Participant_FName">First Name:</label>
<input type="input" name="Participant_FName" value="<?php echo $Participant->Participant_FName ?>"/><br />

<label for="Participant_Email">Email:</label>
<input type="input" name="Participant_Email" value="<?php echo $Participant->Participant_Email ?>"/><br />

<label for="QRCode">QRCode:</label>
<input type="input" name="QRCode" value="<?php echo $Participant->QRCode ?>"/><br />

<label for="Participant_Website">Personal Website:</label>
<input type="input" name="Participant_Website" value="<?php echo $Participant->Participant_Website ?>"/><br />

<label for="Participant_Picture">Picture:</label>
<input type="file" name="userfile" /><br />

<input type="submit" name="submit" value="Edit Your Profile" />

</form>
