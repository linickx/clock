<?php
/**
	Dump the cache
**/
$memcache = new Memcache;
echo '<pre>';
for ($i = 1; $i < 20; $i++) {

	$bg_meta_key = "bg_meta_" . $i;

	if ($bg_meta = $memcache->get($bg_meta_key)) {
		echo "$bg_meta_key \n";
		print_r($bg_meta);
		echo "\n";
	}
}

#if ($bg_feed = $memcache->get('bg_feed')) { 
#	print_r($bg_feed);
#}

#$api = json_decode(file_get_contents("http://simpledesktops.com/api/desktop/random/"));
#$api_pk = $api->pk;
#$api_url = "http://simpledesktops.com/download/?desktop=" . $api_pk;
#$result = get_headers($api_url, 1);
#print_r($result);

echo '</pre>';
?>