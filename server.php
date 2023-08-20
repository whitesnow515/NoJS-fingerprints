<?php

$host = 'localhost';  // replace with your database host
$username = 'wju';  // replace with your database username
$password = '123';  // replace with your database password
$database = 'fingerprints';  // replace with your database name

$conn = mysqli_connect($host, $username, $password, $database);

$data = $_GET['data']; 
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$ipAddress = $_SERVER['REMOTE_ADDR'];

$browser = get_browser(null, true);
$uniqueValue = $browser['browser'] . '_' . $browser['version'];

echo $data;

$fingerprint = hash('sha256', $userAgent.$ipAddress);

header("Content-type: text/css");

// echo ".dynamic-element { color: #ff0000;}";
// echo ".dynamic-element:after { content: '$fingerprint'}";

// Check the connection
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// $data = $_GET["data"];

$sql = "INSERT INTO finger_table (data) VALUES ('$fingerprint')";

if (mysqli_query($conn, $sql)) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);

?>

