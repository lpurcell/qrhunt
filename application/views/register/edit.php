<h2>Edit your Profile</h2>

<div class="menu">
    <ul>
        <li><a href="<?php echo site_url('scan_view/'.$Participant->Participant_ID)?>">See Your Points</a></li>
        <li><a href="<?php echo site_url('scanned_by/'.$Participant->QRCode)?>">See Who Scanned You</a></li>
        <li><a href="<?php echo site_url('scan/scanned_most')?>">See Most Scanned</a></li>
        <li><a href="<?php echo site_url('scan/totals')?>">See Game Points</a></li>

    </ul>
</div>
<br/>

<?php echo validation_errors(); ?>
<?php ?>
<p>
    <?php if ($Participant->Participant_Picture === "0" || $Participant->Participant_Picture === ""){ ?>
        <img src="<?php echo base_url(); ?>assets/images/avatar.jpg">
    <?php }else{ ?>
        <img src= "<?= base_url();?>uploads/<?= $Participant->Participant_Picture; ?>">
    <?php } ?>
</p>
<?php echo form_open_multipart('participant_edit/'.$Participant->Participant_ID) ?>

<input type ="hidden" name="Event_ID" value="<?php echo $Participant->Event_ID; ?>">

<input type ="hidden" name="PARTICIPANT_ID" value="<?php echo $Participant->Participant_ID; ?>">

<label for="Participant_LName">Last Name:</label>
<input type="text" name="Participant_LName" value="<?php echo $Participant->Participant_LName; ?>"/><br />

<label for="Participant_FName">First Name:</label>
<input type="input" name="Participant_FName" value="<?php echo $Participant->Participant_FName; ?>"/><br />

<label for="Participant_Email">Email:</label>
<input type="input" name="Participant_Email" value="<?php echo $Participant->Participant_Email; ?>"/><br />

<label for="Event_ID">Choose your Event:</label>
<select name="Event_ID">
    <?php foreach($event as $event_item): ?>
        <option  value="<?php echo $event_item->Event_ID; ?>" <?php if ($event_item->Event_ID == $Participant->Event_ID){ echo "selected='selected'"; }else{ ''; } ?> ><?php echo $event_item->Event_Name; ?></option>
    <?php endforeach ?>
</select><br/>

<label for="QRCode">QRCode:</label>
<input type="input" name="QRCode" value="<?php echo $Participant->QRCode; ?>"/><br />

<label for="Participant_Website">Personal Website:</label>
<input type="input" name="Participant_Website" value="<?php echo $Participant->Participant_Website; ?>"/><br />

<label for="Participant_Picture">Picture:</label>
<input type="file" name="userfile" /><br />

<input type="submit" name="submit" value="Edit Your Profile" />

</form>
