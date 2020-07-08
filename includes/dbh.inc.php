<?php
// Connecting the Database to the Script
// Declaring all the appropriate settings.
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "loginsystem";

// assigning a variable to the mySqli_connect funtion so i can check for errors.
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}