<?php  
	require 'config/config.php';
	require 'includes/form_handlers/register_handler.php';
	require 'includes/form_handlers/login_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>FriendBook</title>
    <link rel="icon" type="image/x-icon" href="assets/images/icons/favicon.png"><!-- FAVICON -->
    <link rel="stylesheet" href="assets/stylesheets/style.css"><!-- Stylesheet -->

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/loader.js"></script>
</head>
<body>
    <!-- Loads the wrapper -->
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>