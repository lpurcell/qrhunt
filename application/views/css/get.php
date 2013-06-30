<?php header("Content-type: text/css");

        foreach($tests as $test){
             $Event_Logo = $test->Event_Logo;
             $Event_Maincolor = $test->Event_Maincolor;
             $Event_Textcolor = $test->Event_Textcolor;
             $Event_Headercolor = $test->Event_Headercolor;
        }
        ?>
        *{
        margin:0px;
        padding:0px;
        }
        body {
        background:<?=$Event_Maincolor?>;
        color:<?=$Event_Textcolor?>;
        margin-left: 20%;
        text-align:center;
        }
        .wrap{
        margin-top:5%;
        width: 70%;
        background:white;
        box-shadow:0px 0px 15px 5px #888888;
        }
        .header{
        background:<?=$Event_Headercolor?>;

        }
        .logo{
        background-image:url('<?php
                if ($Event_Logo === "0"){
                    echo base_url()?>assets/images/default_logo.jpg');
                <?php
                }else{
                echo base_url()?>assets/images/<?= $Event_Logo?>');
                <?php
                }
                ?>


        background-repeat:no-repeat;
        margin-left:30px;

        height:180px;
        }
        label{
        display:inline-block;
        width: 125px;
        text-align: left;
        }
        input{
        width: 200;
        }
