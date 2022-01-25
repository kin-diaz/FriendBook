<?php  
    require 'config/config.php';
    include("includes/classes/User.php");
    include("includes/classes/Post.php");

    // Checks if there is a username in the session variable (indicates theres a user).
    if (isset($_SESSION['username'])) {
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
    }
    else {
        header("Location: index.php"); //If not, redirects the user back to the index page.
    }

    // Post button
    if(isset($_POST['post'])){

        $uploadOk = 1;
        $imageName = $_FILES['fileToUpload']['name'];
        $errorMessage = "";
    
        if($imageName != "") {
            $targetDir = "assets/images/posts/";
            $imageName = $targetDir . uniqid() . basename($imageName);
            $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
    
            if($_FILES['fileToUpload']['size'] > 10000000) {
                $errorMessage = "Sorry your file is too large";
                $uploadOk = 0;
            }
    
            if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
                $errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
                $uploadOk = 0;
            }
    
            if($uploadOk) {
                
                if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
                    //Image uploaded okay.
                }
                else {
                    //Image did not upload.
                    $uploadOk = 0;
                }
            }
        }
    
        if($uploadOk) {
            $post = new Post($con, $userLoggedIn);
            $post->submitPost($_POST['post_text'], 'none', $imageName);
            header("Location: main.php");
        }
        else {
            echo "<div style='text-align:center;' class='alert alert-danger'>
                    $errorMessage
                </div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FriendBook</title>
    <link rel="icon" type="image/x-icon" href="assets/images/icons/favicon.png"><!-- FAVICON -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/stylesheets/style-2.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Loads main AJAX file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
    
    <!-- Link to all the system Javascripts -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/jquery.Jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>
</head>
<body>
    <!-- Header with logo and navigation links -->
    <div class="header">
        <div class="logo">
            <img src="assets/images/icons/logo.png" alt="logo" onclick="location.href='main.php'">
        </div> 
        <div class="icons">
            <button class="post-btn" id="post-btn"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
            <button class="notif-btn" id="notif-btn" onclick="location.href='requests.php'"><i class="fa fa-bell fa-2x" aria-hidden="true"></i></button>
            <button class="explore-btn" id="explore-btn" onclick="location.href='explore.php'"><i class="fa fa-compass fa-2x" aria-hidden="true"></i></button>
            <button class="settings-btn" id="settings-btn" onclick="location.href='settings.php'"><i class="fa fa-cog fa-2x" aria-hidden="true"></i></button>
            <a href="<?php echo $userLoggedIn; ?>"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a>
            <a href="includes/handlers/logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a>
        </div>
    </div>

    <!-- POST button container - hidden at first until button clicked -->
    <div class="modal-container" id="modal-container">
        <div class="modal">
            <div class="close-btn" id="close-btn"><i class="fa fa-close fa-2x" aria-hidden="true"></i></div>
            <h3>CREATE YOUR POST</h3>
            <div>
                <form class="post_form" action="main.php" method="POST" enctype="multipart/form-data">
                    <textarea name="post_text" id="post_text" class="post-text" placeholder="What do you want to share?"></textarea>
			        <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" name="post" id="post_button" class="create-post-btn" value="POST">
                    <hr>
                </form>
            </div>
        </div>
    </div>