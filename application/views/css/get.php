<?php header("Content-type: text/css");

        foreach($event as $event_item){
             $Event_Logo = $event_item->Event_Logo;
             $Event_Maincolor = $event_item->Event_Maincolor;
             $Event_Textcolor = $event_item->Event_Textcolor;
             $Event_Headercolor = $event_item->Event_Headercolor;
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
        background-position: center;
        background-repeat:no-repeat;
        background-radius:20px;
        border: none;
        height:30%;
        }
        .footer{
        padding-top:3%;
        clear:both;
        }
        label{
        display:inline-block;
        width: 125px;
        text-align: left;
        }
        input{
        width: 200;
        }
