<?php

// Get request parameters
$uri = $_POST['uri'];
$method = $_POST['method'];
$payload = $_POST['payload'];

#$uri = "http://fingertips-server-dev/users/?format=json";
#$uri = "http://google.pt";
#$method = "GET";
#$payload = "username=pcandeias";
#


// Prepare CURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $uri);
curl_setopt($ch, CURLOPT_HEADER, 1);
#curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Auth header
$headers = getallheaders();
if (!empty($headers['Authorization'])) {
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$headers['Authorization']));
}

// GET request
if ($method == 'GET') {
    $out = curl_exec($ch);
}

// POST request
elseif ($method == 'POST') {
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    $out = curl_exec($ch);
}


if (!empty($out)) {
    header('HTTP/1.1 '.curl_getinfo($ch, CURLINFO_HTTP_CODE));
    echo $out;
}

else {
    header('HTTP/1.1 500');
    echo "Request failed to reach the host";
}