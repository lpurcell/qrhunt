<br/>
<div class="menu">
    <ul>
    <?php
        echo "<li>" . anchor('participant/edit_start', 'Add a Participant', 'title="Add a Participant"') . "</li>";
        echo "<li>" . anchor('participants_all', 'View all Participants', 'title="View all Participants"'). "</li>";
        echo "<li>" . anchor('scan/create', 'Create a Scan Manually', 'title="Create a Scan Manually"'). "</li>";
        echo "<li>" . anchor('admin/scan/totals', 'View Points by All Participants', 'title="View Scan Totals"'). "</li>";
        echo "<li>" . anchor('admin/scan/group_totals', 'View Points by Group', 'title="View Group Totals"'). "</li><br/>";

        echo "<li>" . anchor('extra_points', 'Get EXTRA Points!', 'title="Get Extra Points"'). "</li><br/>";

        echo "<li>" . anchor('organization/create', 'Register an Organization', 'title="Register an Organization"') . "</li>";
        echo "<li>" . anchor('event/create', 'Register an Event', 'title="Register an Event"') . "</li>";
        echo "<li>" . anchor('participant/generateCodes', 'Generate Multiple QR Codes', 'title="Generate Multiple QR Codes"') . "</li>";
        echo "<li>" . anchor('organization_all', 'View all Organizations', 'title="View all Organizations"'). "</li>";
        echo "<li>" . anchor('events_all', 'View all Events', 'title="View all Events"'). "</li>";