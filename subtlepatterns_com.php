<?php

/**

	Sublepatterns dot com - Random Background

**/


/**
	Get patterns feed from subtlepatterns and cache it.
**/

if (!($bg_feed = $memcache->get('bg_feed'))) { 
	$Response = json_decode(file_get_contents("http://subtlepatterns.com/?feed=json"));
	$memcache->set('bg_feed', $Response, "14400");
	$bg_feed = $Response;
}

/**
	Process pattern feed and produce $bg_meta['background_url'] for all memcache keys.
**/ 

for ($i = 0; $i < 10; $i++) {
	
	$this_meta_key = "bg_meta_" . ($i+1)*2; // The even meta_key numbers will be subtle patterns

	$bg_feed_bg_content = strtolower($bg_feed[$i]->content); // Pick a random pattern, the URL is hidden in the content object.
	$url_pattern = "/url\(([^\)]+)\)/"; // match url('/patterns/skulls.png')
	preg_match($url_pattern, $bg_feed_bg_content, $matches);
	$background_url = substr($matches[0], 3);
	$bad_char = array("(", "'", ")");
	$bg_meta['background_url'] = "http://subtlepatterns.com" . str_replace($bad_char, "", $background_url);

	/**
		Match font colour to background - $bg_meta['font_colour']
	**/
	foreach ($bg_feed[$i]->tags as $tag ) {
		
		if ($tag->title == "dark") {
			$bg_meta['font_colour'] = "#ffffff";
		}
	
		if ($tag->title == "light") {
			$bg_meta['font_colour'] = "#000000";
		}	 
	}

	$memcache->set($this_meta_key, $bg_meta, "14400"); // cache hard work for future use!

}

/**
	Return the current meta, for the current key to JSON
**/
$bg_meta = $memcache->get($bg_meta_key);
?>