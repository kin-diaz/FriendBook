<?php 
// Simple logout handler.
session_start(); //Starts the sessio so there's no error.
session_destroy(); //Destroys the session.
header("Location: ../../index.php") //Redirects to index.php page
 ?>