<?php

$response = get_web_page("https://api.spotify.com/v1/audio-analysis/".$_SESSION[$ID]);
//$response = get_web_page("http://requestbin.fullcontact.com/1i2e3yy1");
$resArr = array();
$resArr = json_decode($response);
echo "<pre>"; var_dump($response); echo "</pre>";
echo "END";

function get_web_page($url) {
    $options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "test", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
		CURLOPT_VERBOSE 	   => true,
    );

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_FAILONERROR,true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Accept: application/json',
		'Content-Type: application/json',
		'Authorization: Bearer '.$_SESSION[$OAT]
	));

    $content  = curl_exec($ch);
	$error =  curl_error($ch);
	curl_close($ch);

	if($content === false) {
		return $error;
	}

    return $content;
}
?>
