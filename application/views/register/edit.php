<h2>Edit your Profile</h2>
<a href="<?php echo site_url('scan_view/'.$Participant->Participant_ID)?>">See Your Points</a>
<a href="<?php echo site_url('scan/totals')?>">See Game Points</a>
<a href="<?php echo site_url('scanned_by/'.$Participant->QRCode)?>">Your QRCode Scans</a>
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

<input type ="hidden" name="Type" value="<?php echo $Participant->Type; ?>">

<input type ="hidden" name="PARTICIPANT_ID" value="<?php echo $Participant->Participant_ID; ?>">

<label for="Participant_LName">Last Name:</label>
<input type="text" name="Participant_LName" value="<?php echo $Participant->Participant_LName; ?>"/><br />

<label for="Participant_FName">First Name:</label>
<input type="input" name="Participant_FName" value="<?php echo $Participant->Participant_FName; ?>"/><br />

<label for="Group">Email:</label>
<input type="input" name="Group" value="<?php echo $Participant->Group; ?>"/><br />

<label for="Type">Choose your Event:</label>
<select name="Type">
    <?php foreach($event as $event_item): ?>
        <option  value="<?php echo $event_item->Type; ?>" <?php if ($event_item->Type == $Participant->Type){ echo "selected='selected'"; }else{ ''; } ?> ><?php echo $event_item->Event_Name; ?></option>
    <?php endforeach ?>
</select><br/>

<label for="QRCode">QRCode:</label>
<input type="input" name="QRCode" value="<?php echo $Participant->QRCode; ?>"/><br />

<label for="Major">Major:</label>
<input type="input" name="Major" value="<?php echo $Participant->Major; ?>"/><br />

<input type="submit" name="submit" value="Edit Your Profile" />

</form>
