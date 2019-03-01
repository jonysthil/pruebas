<?php
date_default_timezone_set("America/Mexico_City");
/**
 * Define database parameters here
 */
define("DB_USER", 'admin');
define("DB_PASSWORD", '$AES-128-CBC$o8lbFUnf0k33q4L6cwklYg==$3zbyJblM+4h1ZLP4gwExdIKLTUWOMuwrKd2QoQQaEOM=');
define("DB_NAME", 'respaldo');
define("DB_HOST", '127.0.0.1');
define("DB_CHARSET", 'utf8');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (mysqli_connect_errno()) {
    throw new Exception('ERROR connecting database: ' . mysqli_connect_error());
    die();
} 

if (!mysqli_set_charset($conn, DB_CHARSET)) {
    mysqli_query($conn, 'SET NAMES '.DB_CHARSET);
}

$database = array();
$result = mysqli_query($conn, 'SHOW DATABASES');
while($row = mysqli_fetch_row($result)) {
    $database[] = $row[0];
}

foreach($database as $table) {
    echo "<pre>";
    echo $table;
}

?>