<?php

include_once 'RestfulAPI.php';

$service = new RestfulAPI();
$service->handleRawRequest($_SERVER, $_GET, $_POST);
?>
