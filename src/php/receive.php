<?php
/* basic script to see POST body(data) */
$request = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);
var_dump($data);
?>