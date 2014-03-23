<?php

	/**

		It all starts here!

	**/

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>LINICK clock</title>

<link rel="author" href="https://plus.google.com/+NickBettison" title="Nick Bettison on Google+" />
<link rel="help" href="http://www.linickx.com/3941/the-linickx-clock-power-by-jquery-css3-and-google-app-engine" />

<style type="text/css">
body{
	 background:#202020;
	 font-family: sans-serif;
	 font-size: 12px;
	 font-weight: bold;
	 margin:0;
	 padding:0;
	 color:#bbbbbb; 
}

a {
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
}

.container {margin: 0 auto; overflow: hidden; }

.clock { padding:30px; color:#fff; 

  height: 50%;
  overflow: auto;
  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;

}

ul {  margin:0 auto; padding:0px; list-style:none; text-align:center; }
ul li { display:inline; font-size:10em; text-align:center; }

.point { position:relative; -moz-animation:mymove 1s ease infinite; -webkit-animation:mymove 1s ease infinite; padding-left:10px; padding-right:10px; }

@-webkit-keyframes mymove 
{
0% {opacity:1.0;}
50% {opacity:0;}
100% {opacity:1.0;}	
}


@-moz-keyframes mymove 
{
0% {opacity:1.0;}
50% {opacity:0;}
100% {opacity:1.0;}	
}

#box {
	text-align:center;
	font-size:2em;
}

</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

setInterval( function() {
	// Create a newDate() object and extract the seconds of the current time on the visitor's
	var seconds = new Date().getSeconds();
	// Add a leading zero to seconds value
	$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
	},1000);
	
setInterval( function() {
	// Create a newDate() object and extract the minutes of the current time on the visitor's
	var minutes = new Date().getMinutes();
	// Add a leading zero to the minutes value
	$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
	
setInterval( function() {
	// Create a newDate() object and extract the hours of the current time on the visitor's
	var hours = new Date().getHours();
	// Add a leading zero to the hours value
	$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);

setInterval( function() {

	 $.getJSON('/rd').success(function(data){ 

	 	$(".point").html(data.clock_delimter);
	 	//$("body").css('background-image', "url(");
	 	//$('body').css('background', 'url('+data.background_url+') repeat');
	 	$('body').css('background', 'url('+data.background_url+') '+data.background_repeat+'');
		 	if (data.background_repeat == 'no-repeat') { $('body').css('background-size', '100%'); };
	 	$('body').css('font-family', data.font_family);
	 	$(".clock").css('color', data.font_colour);
	 	
	 	$("#box").html(data.box_html);	

	 });
	}, 900000);

// http://stackoverflow.com/questions/1191865/code-for-a-simple-javascript-countdown-timer
var count=900;
var counter=setInterval(timer, 1000);

function timer()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     return;
  }

 $("#timer").html(count);
}
	
}); 


</script>
</head>
<body>
<!--
	Inspired by: http://www.alessioatzeni.com/blog/css3-digital-clock-with-jquery/
-->
<div class="container">
<!-- <div id="debug">debug area</div> -->

	<div class="clock">
	<ul>
		<li id="hours"> </li>
	    <li class="point">:</li>
	    <li id="min"> </li>
	    <li class="point">:</li>
	    <li id="sec"> </li>
	</ul>
		<div id="box">
			<style type="text/css"> a:link, a:visited, a:active { color: #ffffff; } </style>
			<p><a href="/about">/about</a></p>
			<p>This page will change every 15mins, you have to wait: <span id="timer">900</span> seconds</p>
		</div>
	</div>
</div>
</body>
</html>
