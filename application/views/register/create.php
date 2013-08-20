
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
        <td><input type="text" name="Participant_LName" value="<?php echo set_value('Participant_LName')?>"/><br /></td>
    </tr>

    <tr>
        <td><label for="Participant_FName">First Name:</label></td>
        <td><input type="input" name="Participant_FName" value="<?php echo set_value('Participant_FName')?>"/><br /></td>
    </tr>

    <tr>
        <td><label for="Group">Group:</label></td>
        <td><input type="input" name="Group" value="<?php echo set_value('Group')?>"/><br /></td>
    </tr>

    <tr>
        <td><label for="Type">Participant Type:</label></td>
        <td>
            <select name="Type">
                <option value="PAR">Participant</option>
                <option value="LEA">Leader</option>
                <option value="ORG">Organization</option>
                <option value="SCA">Scavenger Hunt</option>

            </select>
        </td>
    </tr>

    <tr>
        <td><label for="QRCode">QRCode:</label></td>
        <td><input type="button" value="Generate" onClick="generate();" /></td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td><input type="input" name="QRCode" id="QRField" value="<?php echo set_value('QRCode')?>"/><br /></td>
    </tr>

    <tr>
        <td>&nbsp;</td>
        <td><div id="codeArea"></div></td>
    </tr>

    <tr>
        <td><label for="Major">Major:</label></td>
        <td><input type="input" name="Major" value="<?php echo set_value('Major')?>"/><br /></td>
    </tr>

</table>
<br  />
<input type="submit" name="submit" value="Register Your Profile" />

</form>