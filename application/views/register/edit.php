<h2>Edit Profile for QRCode:</h2>
<h2><?php echo $Participant->QRCode ?></h2>

<?php echo validation_errors(); ?>
<?php ?>
<p>
    <?php if ($Participant->Type == "PAR") {
        ?>
        <img src="<?php echo base_url(); ?>assets/images/avatar.jpg">
    <?php
    }else{
        ?>
        <img src= "<?= base_url();?>assets/images/griffonResize.jpg">
    <?php
    }
    ?>
</p>
<?php echo form_open_multipart('participant_edit/'.$Participant->QRCode) ?>

<input type ="hidden" name="PARTICIPANT_ID" value="<?php echo $Participant->Participant_ID; ?>">
<input type ="hidden" name="QRCode" value="<?php echo $Participant->QRCode; ?>">

<label for="Participant_LName">Last Name:</label>
<input type="text" name="Participant_LName" value="<?php echo $Participant->Participant_LName; ?>"/><br />

<label for="Participant_FName">First Name:</label>
<input type="input" name="Participant_FName" value="<?php echo $Participant->Participant_FName; ?>"/><br />

<label for="Groups">Group:</label>
<input type="input" name="Groups" value="<?php echo $Participant->Groups; ?>"/><br />

<label for="Type">Type:</label>
<select name="Type">
        <option value="PAR" <?php if ($Participant->Type == "PAR") {echo "selected='selected'";}?> >Participant</option>
        <option value="LEA" <?php if ($Participant->Type == "LEA") {echo "selected='selected'";}?> >Leader</option>
        <option value="ORG" <?php if ($Participant->Type == "ORG") {echo "selected='selected'";}?> >Organization</option>
        <option value="SCA" <?php if ($Participant->Type == "SCA") {echo "selected='selected'";}?> >Scavenger Hunt</option>
</select><br/>

<label for="Major">Major:</label>
<input type="input" name="Major" value="<?php echo $Participant->Major; ?>"/><br />

<input type="submit" name="submit" value="Edit Profile" />

</form>
