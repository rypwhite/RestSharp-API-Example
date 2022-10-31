<?php
header('Content-Type: application/json; charset=utf-8');

$headers = apache_request_headers();

//store this in a .env or something?
$api_key = "0f80631b-0145-4d77-ab70-c1e845063cc3";

if ($headers["X-Api-Key"] != $api_key) {
	header('HTTP/1.0 403 Forbidden');
    die('You are not allowed to access this file.');     
}

if (!isset($_GET["username"]) || $_GET["username"] == null) {
	$response = array(
		"status" => "error",
		"message" => "no username given!"
	); 
	
	die(json_encode($response, JSON_PRETTY_PRINT));
}

$username = $_GET["username"];

$connect = new mysqli("plesk.remote.ac","WS301022_csdp","U1f6x1g1@","WS301022_csdp");
$SQL = "SELECT * FROM `users` WHERE `username` = ?";

$stmt = mysqli_prepare($connect, $SQL);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 1)
{
    $user = mysqli_fetch_assoc($result);

    $response = array(
		"status" => "success",
		"message" => "User " . $user['username'] . " found"
	); 

    die(json_encode($response, JSON_PRETTY_PRINT));
}

mysqli_stmt_close($stmt);

$response = array(
    "status" => "error",
    "message" => "no user found!"
); 

die(json_encode($response, JSON_PRETTY_PRINT));
