<?php  
// AJAX load for calling all the posts.

include("../../config/config.php");
include("../classes/User.php");
include("../classes/Post.php");

$limit = 10; //Number of posts to be loaded per call.

$posts = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadPosts($_REQUEST, $limit); //Calls the loadPosts() function.
?>