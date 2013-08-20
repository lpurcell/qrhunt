<br/>
<div class="menu">
    <ul>
    <?php
        echo "<li>" . anchor('participant/edit_start', 'Add/Edit a Participant', 'title="Add a Participant"') . "</li>";
        echo "<li>" . anchor('scan/create', 'Create a Scan Manually', 'title="Create a Scan Manually"'). "</li>";
        echo "<li>" . anchor('participants_all', 'View all Participants', 'title="View all Participants"'). "</li><br/>";

        echo "<li>" . anchor('admin/scan/totals', 'View Points by All Participants', 'title="View Scan Totals"'). "</li>";
        echo "<li>" . anchor('admin/scan/group_totals', 'View Points by Group', 'title="View Group Totals"'). "</li><br/>";

        echo "<li>" . anchor('extra_points', 'Get EXTRA Points!', 'title="Get Extra Points"'). "</li><br/>";

        echo "<li>" . anchor('admin/delete_cookies', 'Delete Cookies', 'title="Delete Cookie"'). "</li>";
