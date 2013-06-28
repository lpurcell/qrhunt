<?php
foreach($tests as $test){ ?>
    <li><?php echo $test->Event_Name;?></li>
    <li><?php echo $test->Event_Logo;?></li>
<?php
}

//echo '<h2>'.$data['Event_Name'].'</h2>';
//echo '<h2>'.$data['data'].'</h2>';
/* if(!empty($news)){
  foreach ($news as $one){
echo '<h2>'.$one['events'].'</h2>';
  }}
else{
   echo "You have no data";
}*/