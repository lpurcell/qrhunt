<script src="<?php echo base_url()?>assets/js/qrcode_SJIS.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/qrcode.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/generate.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

<h2>Register your Profile</h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('register/create') ?>


<table>

    <tr>
        <td><label for="Participant_LName">Last Name:</label></td>
        <td><input type="text" name="Participant_LName" /></td>
    </tr>

    <tr>
        <td><label for="Participant_FName">First Name:</label></td>
        <td><input type="input" name="Participant_FName" /></td>
    </tr>

    <tr>
        <td><label for="Participant_Email">Email:</label></td>
        <td><input type="input" name="Participant_Email" /></td>
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
        <td><input type="input" name="QRCode" id="QRField" /></td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td><div id="codeArea"></div></td>
    </tr>

    <tr>
        <td><label for="Participant_Website">Personal Website:</label></td>
        <td><input type="input" name="Participant_Website" /></td>
    </tr>

    <tr>
        <td><label for="Participant_Picture">Picture:</label></td>
        <td><input type="file" name="userfile" /></td>
    </tr>
</table>
<br  />
<input type="submit" name="submit" value="Register Your Profile" />


</form>