<?php 
include("includes/header2.php");

// Profile page.

if(isset($_GET['profile_username'])) {
    //Creates the variables.
    $username = $_GET['profile_username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
    $user_array = mysqli_fetch_array($user_details_query);
    $num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
}

//Creates a new User object & shows remove friend
if(isset($_POST['remove_friend'])) {
    $user = new User($con, $userLoggedIn);
    $user->removeFriend($username);
}
//Creates a new User object & shows sent request
if(isset($_POST['add_friend'])) {
    $user = new User($con, $userLoggedIn);
    $user->sendRequest($username);
}
//Redirects to request page. 
if(isset($_POST['respond_request'])) {
    header("Location: requests.php"); 
}
?>

    <div class="profile-page">
        <div class="left">
            <h4>#<?php echo $user_array['username']; ?></h4>
            <p class="info">See a single person's posts.</p>
            <div class="posts_area"></div>
            <img id="loading" src="assets/images/icons/loading.gif" width="50" height="50">
        </div>
        <div class="right">
            <div class="card">
                <button class="edit-btn" onclick="location.href='settings.php'">EDIT</button>
                <a href="<?php echo $userLoggedIn; ?>" class="prof-img"><img src="<?php echo $user_array['profile_pic']; ?>"></a>
                <a class="name"><?php echo $user_array['first_name'] . " " . $user_array['last_name']; ?></a>
                <p class="username">@<?php echo $user_array['username']; ?></p>
                <div class="stats">
                    <div class="posts"><?php echo $user_array['num_posts'] ?>
                        <p>Posts</p>
                    </div>
                    <div class="posts"><?php echo $user_array['num_likes'] ?>
                        <p>Likes</p>
                    </div>
                </div>
                
                <form action="<?php echo $username; ?>" method="POST">
                <?php 
                $profile_user_obj = new User($con, $username); 
                if($profile_user_obj->isClosed()) {
                    header("Location: user-closed.php"); //Redirects users if the account is closed.
                }
                $logged_in_user_obj = new User($con, $userLoggedIn); 

                // Changes the buttons accordingly.
                if($userLoggedIn != $username) {
                    if($logged_in_user_obj->isFriend($username)) {
                        echo '<input type="submit" name="remove_friend" class="remove_friend" value="Remove Friend"><br>';
                    }
                    else if ($logged_in_user_obj->didReceiveRequest($username)) {
                        echo '<input type="submit" name="respond_request" class="respond_request" value="Respond to Request"><br>';
                    }
                    else if ($logged_in_user_obj->didSendRequest($username)) {
                        echo '<input type="submit" name="cancel_request" class="cancel_request" value="Request Sent"><br>';
                    }
                    else 
                        echo '<input type="submit" name="add_friend" class="add_friend" value="Add Friend"><br>';
                }
                ?>
                </form>
            </div>
            <footer style="font-size: 12px;"><p>Copyright ©️ 2021 Bath Spa University | All Rights Reserved</p></footer><!-- Footer -->
        </div>
        
        <!-- Javascript for calling the AJAX request to load posts. -->
        <script>
            $(function(){
                var userLoggedIn = '<?php echo $userLoggedIn; ?>';
                var profileUsername = '<?php echo $username; ?>';
                var inProgress = false;
        
                loadPosts(); //Load first posts
        
                $(window).scroll(function() {
                    var bottomElement = $(".status_post").last();
                    var noMorePosts = $('.posts_area').find('.noMorePosts').val();            
                
                    if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
                    loadPosts();
                    }
                });
        
                function loadPosts() {
                    if(inProgress) {
                    return;
                    }
                
                    inProgress = true;
                    $('#loading').show();
        
                    var page = $('.posts_area').find('.nextPage').val() || 1;
        
                    $.ajax({
                        url: "includes/handlers/ajax_load_profile_posts.php",
                        type: "POST",
                        data: "page="+page+"&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
                        cache:false,
        
                        success: function(response) {
                            $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage
                            $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage
                            $('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage
        
                            $('#loading').hide();
                            $(".posts_area").append(response);
        
                            inProgress = false;
                        }
                    });
                }
        
                //Check if the element is in view.
                function isElementInView (el) {
                    if(el == null) {
                        return;
                    }
        
                    var rect = el.getBoundingClientRect();
        
                    return (
                        rect.top >= 0 &&
                        rect.left >= 0 &&
                        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
                        rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
                    );
                }
            });
        </script>
        <script src="assets/js/post.js"></script><!-- Post button -->
    </div>
</body>
</html>