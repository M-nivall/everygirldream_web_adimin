<?php

/* ==============================
   OLD LOCAL DATABASE (COMMENTED)
   ==============================
$con = mysqli_connect('localhost', 'root', '', 'every_girls_dream');
if (!$con) {
    echo 'could not connect to the database';
}
*/

/* ==============================
   RAILWAY DATABASE CONFIG
   ============================== */

$host     = "zephyr.proxy.rlwy.net";
$user     = "root";
$password = "vwukUfsZVrYOjHdkSaIJzaTvsldRwXik";
$database = "every_girls_dream";
$port     = 58449;

$con = mysqli_connect($host, $user, $password, $database, $port);

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$siteName = 'Refnet';
?>