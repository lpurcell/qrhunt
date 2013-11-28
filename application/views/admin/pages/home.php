<div class=menu>
<?php
echo "<br/>" . anchor('admin/user/user', 'View QR Users', 'title="View QR Users"') . "<br/>";
echo  anchor('admin/organization/create', 'Register an Organization', 'title="Register an Organization"') . "<br/>";
echo anchor('admin/event/create', 'Register an Event', 'title="Register an Event"') . "<br/>";
echo anchor('admin/register/create', 'Register a Participant', 'title="Register a Participant"')."<br/>";
echo anchor('admin/labels', 'Generate Labels', 'title="Generate Labels"')."<br/>";
//echo anchor('scan/create', 'Create a Scan Manually', 'title="Create a Scan Manually"')."<br/>";
echo anchor('participants_all', 'View all Participants', 'title="View all Participants"')."<br/>";
echo anchor('organization_all', 'View all Organizations', 'title="View all Organizations"')."<br/>";
echo anchor('events_all', 'View all Events', 'title="View all Events"')."<br/>";
echo anchor('admin/scan/totals', 'View Game Points', 'title="View Scan Totals"')."<br/>";
echo anchor('scan/delete_cookies', 'Delete Cookie', 'title="Delete Cookie"')."<br/>";
echo anchor('admin/user/logout', '<i class="icon-off"></i> Logout'); 

?>
</div>
