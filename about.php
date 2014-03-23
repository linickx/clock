<?php

	/**

		About!

	**/

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>About the LINICKX clock</title>

<link rel="author" href="https://plus.google.com/+NickBettison" title="Nick Bettison on Google+" />
<link rel="help" href="http://www.linickx.com/3941/the-linickx-clock-power-by-jquery-css3-and-google-app-engine" />

<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.getJSON('/rd').success(function(data){ 
		$('body').css('background', 'url('+data.background_url+') '+data.background_repeat+'');
		 if (data.background_repeat == 'no-repeat') { $('body').css('background-size', '100%'); };
		$('body').css('color', data.font_colour);
	});
});
</script>

<style type="text/css">

body {
	font-family: monospace;
	font-size: 1.5em;
}

a:link, a:visited, a:active { 
	color: #aa0000; 
}
.container {
  position: absolute;
  left: 20%;
  top: 10%;
}
 
.box {
  width: 80%;
  background-color: rgba(128,128,128,0.5);
  padding: 0.1% 2% 0.1% 2%;
}
</style>
</head>
<body>
<div class="container">
	<div class="box">
		<h1>About</h1>
		<p>
			Hello, an welcome to my little clock. <br />
			This clock was a weekend project where I wanted to create an Internet clock which included some variety, every <b>15 Minutes</b> the background (<em>and other aspects</em>) of this clock will update. 
		</p>
		<h2>Credz</h2>
		<ul>
			<li>Inspiration: <a href="http://www.alessioatzeni.com/blog/css3-digital-clock-with-jquery/">alessioatzeni.com</a></li>
			<li>Backgrounds: <a href="http://subtlepatterns.com">Subtlepatterns.com</a> &amp; <a href="http://simpledesktops.com">SimpleDesktops.com</a></li>
			<li>Code: <a href="http://jquery.com">jQuery</a></li>
			<li>Help: <a href="http://stackoverflow.com">StackOverflow</a></li>
			<li>Hosting: <a href="https://developers.google.com/appengine/">Google App Engine</a>
		</ul>
		<p>
			<em>rgds,</em> <br/>
			<b><em><a href="http://www.linickx.com">Nick</a></em></b>
		</p>
	</div>
</div>
</body>
</html>