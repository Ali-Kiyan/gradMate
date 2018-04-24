<?php
// Create a stream
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "secretToken: 007"
    ]
];

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$file = file_get_contents('http://localhost:8888/dissertation/mapdata.php', false, $context);
var_dump($http_response_header);

?>
