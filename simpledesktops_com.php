<?php

/**

	Simple Desktop dot Come - Random Background

**/

/**
	http://stackoverflow.com/questions/5842440/background-image-dark-or-light
**/
// get average luminance, by sampling $num_samples times in both x,y directions
function get_avg_luminance($variable, $num_samples=10) {
    $img = imagecreatefromstring($variable);

    $width = imagesx($img);
    $height = imagesy($img);

    $x_step = intval($width/$num_samples);
    $y_step = intval($height/$num_samples);

    $total_lum = 0;

    $sample_no = 1;

    for ($x=0; $x<$width; $x+=$x_step) {
        for ($y=0; $y<$height; $y+=$y_step) {

            $rgb = imagecolorat($img, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            // choose a simple luminance formula from here
            // http://stackoverflow.com/questions/596216/formula-to-determine-brightness-of-rgb-color
            $lum = ($r+$r+$b+$g+$g+$g)/6;

            $total_lum += $lum;

            // debugging code
 //           echo "$sample_no - XY: $x,$y = $r, $g, $b = $lum<br />";
            $sample_no++;
        }
    }

    // work out the average
    $avg_lum  = $total_lum/$sample_no;

    return $avg_lum;
}

/**

**/
$api = json_decode(file_get_contents("http://simpledesktops.com/api/desktop/random/"));

$api_pk = $api->pk;
$api_url = "http://simpledesktops.com/download/?desktop=" . $api_pk;

/**
    Google And SDK get different results from simpledesktop.com
**/
$result = get_headers($api_url, 1);

if (isset($result["Location"])) { // SDK
    $bg_meta['background_url'] = $result["Location"];
} else { // Google
    $bg_meta['background_url'] = $api_url;
}

$bg_img_key = "bg_img_" . $bg_id;

/**
    Cache the image
**/
if (!($bg_img = $memcache->get($bg_img_key))) {
	
	$bg_img = file_get_contents($bg_meta['background_url']);
	$memcache->set($bg_img_key, $bg_img, "14400");
}

/**
    Inspect the image to determine font colour
**/
 $luminance = get_avg_luminance($bg_img,10);
 #echo "AVG LUMINANCE: $luminance<br />";

 // assume a medium gray is the threshold, #acacac or RGB(172, 172, 172)
 // this equates to a luminance of 170
 if ($luminance > 170) {
    #echo "Black Text<br />";
 	$bg_meta['font_colour'] = "#000000";
 } else {
    #echo 'White Text<br />';
 	$bg_meta['font_colour'] = "#ffffff";
 }

$memcache->set($bg_meta_key, $bg_meta, "14400"); // cache hard work for future use!
?>