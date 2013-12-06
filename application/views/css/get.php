<?php header("Content-type: text/css");

        foreach($event as $event_item){
             $Event_Logo = $event_item->Event_Logo;
             $Event_Maincolor = $event_item->Event_Maincolor;
             $Event_Textcolor = $event_item->Event_Textcolor;
             $Event_Headercolor = $event_item->Event_Headercolor;
             $Event_Logobackground = $event_item->Event_Logobackground;
             $Event_Footer = $event_item->Event_Footer;
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
        width: 70%;
        background:<?=$Event_Headercolor?>;
        border-radius:15px;
        }
        .header{
        background:<?=$Event_Logobackground?>;
        border-radius:15px 15px 0px 0px;

        }
        .logo{
        background-image:url('<?php
                if ($Event_Logo === "0" || $Event_Logo === "" || $Event_Logo === null){
                    echo base_url()?>assets/images/QRHuntLogo5.jpg');
                <?php
                }else{
                echo base_url()?>assets/images/<?= $Event_Logo?>');
                <?php
                }
                ?>
background-position: center;
background-repeat:no-repeat;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size:cover;
border: none;
height:25%;
        }


.menu{
padding: 0px;
margin: 0px;
width: 30%;
margin-left: 35%;
        }

.menu ul{
list-style: none;
padding: 0px;
margin: 0px;
}

.menu li{
border-top: 3px;
padding: 5px;

}

.menu a{
display: block;
background-color: <?=$Event_Maincolor?>;
color: <?=$Event_Textcolor?>;
text-decoration: none;
width: 100%;
font-weight: bold;
border-radius: 20px;
border: 2px solid <?=$Event_Maincolor?>;
}

.menu a:hover {
background-color: <?=$Event_Textcolor?>;
color: white;

}


.home a{
font-family: myriad-pro;
background-color: black;
border: 2px solid white;
text-decoration:none;
padding: 1px;
}
.viewpart h4{
border-bottom: 1px solid <?=$Event_Textcolor?>;
border-top: 1px solid<?=$Event_Textcolor?>;
color: <?=$Event_Logobackground?>;
background-color: <?=$Event_Maincolor?>;
border-radius: 5px;
}

.viewpart img{
position: relative;
top: 20%;
width: 10%;
border-radius: 20px;
}
.viewpart ul{
list-style: none;
border: 2px solid <?=$Event_Textcolor?>;
background-color:<?=$Event_Logobackground?>;
width: 25%;
position: relative;
top: 60%;
left: 35%;
border-radius: 10px;
}
.viewpart li{
list-style: none;
color: <?=$Event_Textcolor?>;


}

.viewpart input{
border: 1px solid <?=$Event_Maincolor?>;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;
}


.participants {
padding: 0px;
margin: 0px;
margin-left: 35%;

}
.participants form{
background-color: <?=$Event_Maincolor?>;
padding: 15px;
border-radius: 20px;
border: 2px solid white;
margin-top: 25px;
width: 50%;

}
.participants p{
color: <?=$Event_Textcolor?>;
background-color: white;
border-radius: 5px;
padding: 2px;
}

.participants h2{
background-color: <?=$Event_Maincolor?>;
Color: <?=$Event_Textcolor?>;
font-weight: bold;
margin: 10px;
border-bottom: 2px solid <?=$Event_Headercolor?>;

}
.participants label{
color: <?=$Event_Textcolor?>;
border-bottom: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;


}

.participants input{
border: 1px solid <?=$Event_Headercolor?>;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;

}
.participants input[type=button]{
border: 3px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 20px;
padding: 3px;
margin-top: 5px;
outline: none;

}
.participants input[type=submit]{
border: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 15px;
padding: 5px;
margin-top: 5px;
outline: none;


}

.participants input[type=file]{
border: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;
}

.participants select{
border: 2px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;

}
.organization {
padding: 0px;
margin: 0px;
width: 30%;
margin-left: 35%;

}
.organization form{
background-color: <?=$Event_Maincolor?>;
padding: 15px;
border-radius: 20px;
border: 2px solid white;
margin-top:50px;
margin-bottom:50px;

}
.organizaiton p{
color: <?=$Event_Textcolor?>;
background-color: white;
border-radius: 5px;
padding: 2px;
}

.organization h2{
background-color: <?=$Event_Maincolor?>;
Color:<?=$Event_Textcolor?>;
font-weight: bold;
margin: 10px;
border-bottom: 2px solid <?=$Event_Headercolor?>;

}
.organization label{
color: <?=$Event_Textcolor?>;
border-bottom: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;


}

.organization input{
border: 1px solid <?=$Event_Headercolor?>;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;

}
.organization input[type=button]{
border: 3px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 20px;
padding: 3px;
margin-top: 5px;
outline: none;

}
.organization input[type=submit]{
border: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 15px;
padding: 5px;
margin-top: 5px;
outline: none;


}

.organization input[type=file]{
border: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;
}

.organization select{
border: 2px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;

}

.event {
padding: 0px;
margin: 0px;
margin-left: 35%;

}
.event form{
background-color: <?=$Event_Maincolor?>;
padding: 15px;
border-radius: 20px;
border: 2px solid white;
margin-top:50px;
margin-bottom:50px;
width: 50%;

}
.event p{
color: <?=$Event_Textcolor?>;
background-color: <?=$Event_Headercolor?>;
border-radius: 5px;
padding: 2px;
}

.event h2{
background-color: <?=$Event_Maincolor?>;
Color: <?=$Event_Textcolor?>;
font-weight: bold;
margin: 10px;
border-bottom: 2px solid <?=$Event_Headercolor?>;

}
.event label{
color: white;
border-bottom: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;


}

.event input{
border: 1px solid <?=$Event_Headercolor?>;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;

}
.event input[type=button]{
border: 3px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 20px;
padding: 3px;
margin-top: 5px;
outline: none;

}
.event input[type=submit]{
border: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 15px;
padding: 5px;
margin-top: 5px;
outline: none;


}

.event input[type=file]{
border: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;
}

.event select{
border: 2px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;

}



.QRmanual {
padding: 0px;
margin: 0px;
width: 30%;
margin-left: 35%;

}
.QRmanual form{
background-color: <?=$Event_Maincolor?>;
padding: 15px;
border-radius: 20px;
border: 2px solid white;
margin-top:50px;
margin-bottom:50px;

}
.QRmanual p{
color: <?=$Event_Textcolor?>;
background-color: white;
border-radius: 5px;
padding: 2px;
}

.QRmanual h2{
background-color: <?=$Event_Maincolor?>;
Color: <?=$Event_Textcolor?>;
font-weight: bold;
margin: 10px;
border-bottom: 2px solid <?=$Event_Headercolor?>;

}
.QRmanual label{
color: <?=$Event_Textcolor?>;
border-bottom: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;


}

.QRmanual input{
border: 1px solid <?=$Event_Headercolor?>;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;

}
.QRmanual input[type=button]{
border: 3px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 20px;
padding: 3px;
margin-top: 5px;
outline: none;

}
.QRmanual input[type=submit]{
border: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 15px;
padding: 5px;
margin-top: 5px;
outline: none;


}

.QRmanual input[type=file]{
border: 1px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;
}

.QRmanual select{
border: 2px solid <?=$Event_Headercolor?>;
font-weight: bold;
border-radius: 5px;
padding: 3px;
margin-top: 5px;
outline: none;
}
label{
width: 125px;
text-align: left;
}
input{
width: 200;
}

h1{
padding: 5px;
}
h1 a, h1 a:hover {
color: <?=$Event_Textcolor?>;




}
.footer{
margin-top: 25px;
background-color: <?=$Event_Footer?>;
border-radius: 0px 0px 15px 15px;
        }
