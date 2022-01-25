<?php
//Starts output buffering and session.
ob_start();
session_start();

// Sets variables for timezone and the connection.
$timezone = date_default_timezone_set("Europe/London");
$con = mysqli_connect("localhost", "root", "", "socialclone");

if(mysqli_connect_errno()) { //Error message if failed connection.
	echo "The database isn't working, try again: " . mysqli_connect_errno();
}
?>