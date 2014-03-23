<?php

/**

	rdata.php - Random Data

	JSON output used to update the clock styles with random data.

**/

$memcache = new Memcache;

$bg_id = rand(1, 20); // generate a random number for upto 10 images
#$bg_id = 1;
$bg_meta_key = "bg_meta_" . $bg_id;

if (!($bg_meta = $memcache->get($bg_meta_key))) { // no Meta, generate a new one.

	if ($bg_id % 2 == 0) { // subtlepattern (are even numbers)

		$bg_meta = array('background_repeat'=> "repeat");

		require_once("subtlepatterns_com.php");

	} else { // simple desktop (odd numbers)
		
		$bg_meta = array('background_repeat'=> "no-repeat");

		require_once("simpledesktops_com.php");
	}

}

$background_url = "/bg?id=" . $bg_id; // bg url for clock is our local cache!

/**
	Font Colour - Fall back
**/

//if (!array_key_exists('font_colour', $bg_meta)){}
if (!isset($bg_meta['font_colour'])) {
	$bg_meta['font_colour'] = "#ff0000";
}

/**
	Random Font - $font_family
**/
$fonts = array("serif", "sans-serif", "cursive", "fantasy", "monospace");
$num_of_fonts = count($fonts) -1;
$random_number = rand(0, $num_of_fonts);
$font_family = $fonts[$random_number];

/**
	Random Delimiter for Clock - $clock_delimter
**/
$delimiters = array(":", "-", " ", "|", ".");
$num_of_delimiters = count($delimiters) -1;
$random_number = rand(0, $num_of_delimiters);
$clock_delimter = $delimiters[$random_number];

/**
	Random Box Text
**/

$box_html_data = array();

date_default_timezone_set('Europe/London');
$box_html_data[0] = date("Y-m-d");
$box_html_data[1] = date("j/n/Y");
$box_html_data[2] = date("j/n/y");
$box_html_data[3] = date("l");
$box_html_data[4] = date("F jS");
$box_html_data[5] = date("l jS F");
$box_html_data[6] = date("l jS F Y");

$box_html_data[7] = "";

$box_html_data[8] = '<style type="text/css"> a:link, a:visited, a:active { color: ' . $bg_meta['font_colour'] . '; } </style><a href="/about">/about</a>';
$box_html_data[9] = '<style type="text/css"> a:link, a:visited, a:active { color: ' . $bg_meta['font_colour'] . '; } </style><small>by</small> <a href="http://www.linickx.com">Nick Bettison</a>';
$box_html_data[10] = '<style type="text/css"> a:link, a:visited, a:active { color: ' . $bg_meta['font_colour'] . '; } </style><small>a</small> <a href="http://www.linickx.com">LINICKX</a> <small>production</small>';


$num_of_boxes = count($box_html_data) -1;
$random_number = rand(0, $num_of_boxes);

$box_html = $box_html_data[$random_number];

/**
	Output
**/

$output = array ('background_url'=>$background_url,'clock_delimter'=> $clock_delimter, 'background_repeat'=> $bg_meta['background_repeat'], 'font_colour'=> $bg_meta['font_colour'], 'font_family'=>$font_family, 'box_html'=>$box_html);
$output = json_encode($output);


header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

header('Content-Type: text/javascript');
echo $output;
exit;

?>