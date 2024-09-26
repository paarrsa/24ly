<?php

// ################################################## //

// Checking the existence of url -------------------- //
if(!isset($_GET['url'])) {
    $error = array("ok" => "false", "reason" => "Bad request.");
    echo json_encode($error);
    exit();
} else {
    $url = $_GET['url'];
}
// -------------------------------------------------- //

// ################################################## //

// Checking that the url is correct ----------------- //
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    $error = array("ok" => "false", "reason" => "Url is not correct.");
    echo json_encode($error);
    exit();
}
// -------------------------------------------------- //

// ################################################## //

// Creating a random alias for url ------------------
$str = "ABCDEFGHIJKLMNOPQRSTUVWSYZabcdefghijklmnopqrstuvwsyz1234567890";
$str = str_shuffle($str);
$alias = substr($str, 5, 4);
// -------------------------------------------------- //

// ################################################## //

// Getting user IP address -------------------------- //
$ip = isset($_SERVER['HTTP_CLIENT_IP']) 
    ? $_SERVER['HTTP_CLIENT_IP'] 
    : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) 
      ? $_SERVER['HTTP_X_FORWARDED_FOR'] 
      : $_SERVER['REMOTE_ADDR']);
// -------------------------------------------------- //

// ################################################## //

// Create connection to database -------------------- //
$servername = "";
$username = "";
$password = "";
$db = "";
$conn = mysqli_connect($servername, $username, $password, $db);
// -------------------------------------------------- //

// ################################################## //

// Storing data in the database --------------------- //
$url = bin2hex($url);
mysqli_query($conn, "INSERT INTO links (Alias, URL, IP) VALUES ('$alias', UNHEX('$url'), '$ip')");
// -------------------------------------------------- //

// ################################################## //

// Showing Result ----------------------------------- //
$shortenedURL = "24ly.ir/" . $alias;
$result = array("ok" => "true", "url" => "$shortenedURL");
echo json_encode($result);
exit();
// -------------------------------------------------- //

// ################################################## //