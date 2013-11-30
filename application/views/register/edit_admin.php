<h2><?php echo $title; ?></h2>


<?php echo validation_errors(); ?>
<?php ?>
<p>
    <?php if ($Participant->Participant_Picture === "0" || $Participant->Participant_Picture === "" || $Participant->Participant_Picture === null){ ?>
        <img src="<?php echo base_url(); ?>assets/images/avatar.jpg">
    <?php }else{ ?>
        <img src= "<?= base_url();?>uploads/<?= $Participant->Participant_Picture; ?>">
    <?php } ?>
</p>
<?php echo form_open_multipart('admin/participant_edit/'.$Participant->Participant_ID) ?>

<label for="Event_ID">Choose the Event:</label>
<select name="Event_ID">
    <?php foreach($events as $event):
        echo "<option value='".$event->Event_ID."'";
            if($Participant->Event_ID == $event->Event_ID){
                echo "selected='selected'";
            }else{
                echo '';
            }
        echo ">".$event->Event_Name."</option>";
    endforeach;?>
</select>

<input type ="hidden" name="PARTICIPANT_ID" value="<?php echo $Participant->Participant_ID; ?>">

<label for="Participant_LName">Last Name:</label>
<input type="text" name="Participant_LName" value="<?php echo $Participant->Participant_LName; ?>"/><br />

<label for="Participant_FName">First Name:</label>
<input type="input" name="Participant_FName" value="<?php echo $Participant->Participant_FName; ?>"/><br />

<label for="Participant_Email">Email:</label>
<input type="input" name="Participant_Email" value="<?php echo $Participant->Participant_Email; ?>"/><br />

<input type="hidden" name="QRCode" value="<?php echo $Participant->QRCode; ?>"/>

<label for="MISC1">Misc:</label>
<input type="input" name="MISC1" value="<?php echo $Participant->MISC1; ?>"/><br />

<label for="MISC2">Misc:</label>
<input type="input" name="MISC2" value="<?php echo $Participant->MISC2; ?>"/><br />

<label for="MISC3">Misc:</label>
<input type="input" name="MISC3" value="<?php echo $Participant->MISC3; ?>"/><br />

<label for="Participant_Picture">Picture:</label>
<input type="file" name="userfile" /><br />

<input type="submit" name="submit" value="Edit Player's Profile" />

</form>
