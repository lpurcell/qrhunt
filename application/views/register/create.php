
<script src="<?php echo base_url()?>assets/js/qrcode_SJIS.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/qrcode.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/generate.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<div class=participants>



<?php echo validation_errors(); ?>

<?php echo form_open_multipart('register/create') ?>
    <h2>Register your Profile</h2>


<table>

    <tr>
        <td><label for="Participant_LName">Last Name:</label></td>
        <td><input type="text" name="Participant_LName" value="<?php echo set_value('Participant_LName')?>"/>
            <?php echo form_error('Participant_LName'); ?><br /></td>
    </tr>

    <tr>
        <td><label for="Participant_FName">First Name:</label></td>
        <td><input type="input" name="Participant_FName" value="<?php echo set_value('Participant_FName')?>"/>
            <?php echo form_error('Participant_FName'); ?><br /></td>
    </tr>

    <tr>
        <td><label for="Participant_Email">Email:</label></td>
        <td><input type="input" name="Participant_Email" value="<?php echo set_value('Participant_Email')?>"/>
            <?php echo form_error('Participant_Email'); ?><br /></td>
    </tr>

    <tr>
        <td><label for="Event_ID">Choose your Event:</label></td>
        <td>
            <select name="Event_ID">
                <?php foreach($event as $event_item): ?>
                    <option  value="<?php echo $event_item->Event_ID; ?>"><?php echo $event_item->Event_Name; ?></option>
                <?php endforeach ?>
            </select>
        </td>
    </tr>

    <tr>
        <td><label for="QRCode">QRCode:</label></td>
        <td><input type="button" value="Generate" onClick="generate();" /></td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td><input type="input" name="QRCode" id="QRField" value="<?php echo set_value('QRCode')?>"/>
            <?php echo form_error('QRCode'); ?><br /></td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td><div id="codeArea"></div></td>
    </tr>

    <tr>
        <td><label for="MISC1">Misc:</label></td>
        <td><input type="input" name="MISC1" value="<?php echo set_value('MISC1')?>"/>
            <?php echo form_error('MISC1'); ?><br /></td>
    </tr>

    <tr>
        <td><label for="MISC2">Misc:</label></td>
        <td><input type="input" name="MISC2" value="<?php echo set_value('MISC2')?>"/>
            <?php echo form_error('MISC2'); ?><br /></td>
    </tr>

    <tr>
        <td><label for="MISC3">Misc:</label></td>
        <td><input type="input" name="MISC3" value="<?php echo set_value('MISC3')?>"/>
            <?php echo form_error('MISC3'); ?><br /></td>
    </tr>

    <tr>
        <td><label for="Participant_Picture">Picture:</label></td>
        <td><input type="file" name="userfile" /></td>
    </tr>
</table>
<br  />
<input type="submit" name="submit" value="Register Your Profile" />
</div>
</form>