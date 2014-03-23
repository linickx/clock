<?php

/**

	bg.php - returns a background image.

**/

// The image we present if based on metadata found in a key (id)
if (isset($_GET['id'])) {
	
	// Some basic validation
	if(!is_numeric($_GET['id'])) {
		header("HTTP/1.1 400 BAD REQUEST");
		echo "400";
		exit();
	}

	$id = $_GET['id'];
	settype($id, "integer");

	// Further validation
	if ($id < 1 || $id > 20) {
		header("HTTP/1.1 400 BAD REQUEST");
		echo "400";
		exit();
	} 

	$memcache = new Memcache; // initilise memcache!

	// Our Cache key "id" is generated as follows.
	$bg_meta_key = "bg_meta_" . $id;

	 if (!($bg_meta = $memcache->get($bg_meta_key))) { // default image
	 	$bg_img = file_get_contents("dfbg.png");
	 } else {

	 	$bg_img_key = "bg_img_" . $id;

		if (!($bg_img = $memcache->get($bg_img_key))) {
			
			$bg_img = file_get_contents($bg_meta['background_url']);
			$memcache->set($bg_img_key, $bg_img, "3600");
		}
	 }

	 header('Content-Type: image/png');
	 echo $bg_img;


	#$bg_img_info = getimagesize($bg_img);
	#$bg_img_mime = $bg_img_info['mime'];
	#header("Content-type: $bg_img_mime");
	#readfile($bg_img);
	exit();

} else {
	header("HTTP/1.0 404 Not Found");
	echo "404";
	exit();
}

?>