<div class="event">

<?php echo validation_errors(); ?>


<div class="event">
<?php echo form_open_multipart('admin/event/create') ?>
<h2>Register your Event</h2>
    <table>
        <tr>
            <td><label for="Organization_ID">Choose your Organization:</label></td>
            <td><select name="Organization_ID">
    <?php foreach($organization as $organization_item): ?>
        <option  value="<?php echo $organization_item->Organization_ID; ?>"><?php echo $organization_item->Organization_Name; ?></option>
    <?php endforeach ?>
</select></td></tr><br />
        <tr>
            <td><label for="Event_Name">Event Name:</label></td>
            <td><input type="input" name="Event_Name" value="<?php echo set_value('Event_Name')?>"/></td>
        </tr>
        <tr>
            <td><label for="Event_Location">Location:</label></td>
            <td><input type="text" name="Event_Location" value="<?php echo set_value('Event_Location')?>"/></td>
        </tr>
        <tr>
            <td><label for="Event_Date">Date:</label></td>
            <td><input type="input" id="datepicker" name="Event_Date" value="<?php echo set_value('Event_Date')?>"/></td>
        </tr>
        <tr>
            <td><label for="Event_Coordinator">Coordinator Name:</label></td>
            <td><input type="input" name="Event_Coordinator" value="<?php echo set_value('Event_Coordinator')?>"/></td>
        </tr>
        <tr>
            <td><label for="Event_Email">Coordinator Email:</label></td>
            <td><input type="input" name="Event_Email" value="<?php echo set_value('Event_Email')?>"/></td>
        </tr>
        <tr>
            <td><label for="Event_Logo">Event Logo:</label></td>
            <td><input type="file" name="userfile" value="<?php echo set_value('userfile')?>"/></td>
        </tr>

<div id=>
            <tr>
                <td><label for="Event_Maincolor">Main Color:</label></td>
                <td> <input type="minicolors_main"  name="Event_Maincolor" value="<?php echo set_value('Event_Maincolor')?>"/></td>
            </tr>
</div>
    <div id=>
        <tr>
            <td><label for="Event_Logobackground">Logo Background:</label></td>
            <td><input type="minicolors_Logo"  name="Event_Logobackground" value="<?php echo set_value('Event_Logobackground')?>"/> </td>
        </tr>
    </div>
        <tr>
            <td><label for="Event_Textcolor">Text Color:</label></td>
            <td><input type="minicolors_text" id="minicolors" name="Event_Textcolor" value="<?php echo set_value('Event_Textcolor')?>"/></td>
        </tr>

        <tr>
            <td><label for="Event_Headercolor">Header Color:</label></td>
            <td><input type="minicolors_header" name="Event_Headercolor" value="<?php echo set_value('Event_Headercolor')?>"/></td>
        </tr>

        <tr>
            <td><label for="Event_Footer">Footer Color:</label></td>
            <td><input type="minicolors_footer" name="Event_Footer" value="<?php echo set_value('Event_Footer')?>"/></td>
        </tr>


    </table>
<input type="submit" name="submit" value="Register Your Event" />

</form></div>