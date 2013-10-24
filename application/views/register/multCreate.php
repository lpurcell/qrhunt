<?php
/**
* Created by JetBrains PhpStorm.
* User: Meagan Gates
* Date: 10/15/13
* Time: 2:04 PM
* To change this template use File | Settings | File Templates.
*/
?>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('register/multCreate') ?>

<h2>Register a Group</h2>
<p>Register a group of participants in three easy steps.</p>
<br/>

<h3><u>Step 1:</u></h3>
<table>
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
</table>
<br/>

<h3><u>Step 2:</u></h3>
<p>Download the following file and add your participants to it.</p>
<p>Directions can be found <a href="#" target="_blank">here</a>.</p>
<a href="/qrhunt/downloads/multRegister.csv" target="_blank">Download</a>
<br/><br/>

<h3><u>Step 3:</u></h3>
<label for="CSV_File">Upload your file and hit submit!</label>
<br/>
<input type="file" name="userfile" />
<br/>

<input type="submit" name="submit" value="submit" />
<br/><br/>


