<?php

if(isset($_REQUEST['text']) && !empty($_REQUEST['text']) && filter_var($_REQUEST['text'], FILTER_SANITIZE_STRING)){
	
	$message = $_REQUEST['text'];
	
	//some business logic
	$message = str_replace("!", ".", $message);

	$url = $_ENV['backend-url'];
	
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

	$headers = [];
	$headers[] = 'Content-Type: text/plain';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	
	echo $result;
	
}
