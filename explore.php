<?php 
include("includes/header2.php");
?>
    <!-- Explore page where users can see everyone's post and add friends, chat & meet. -->
    <div class="explore-page">
        <div class="left"><!-- Posts -->
            <h4>#Explore</h4>
            <p class="info">Meet new people and engage in conversations.</p>
            <div class="posts_area"></div>
            <div class="loading-div" width="50px" height="50px"><img id="loading" src="assets/images/icons/loading.gif"></div>
        </div>
        <div class="right"><!-- User details -->
            <div class="card">
                <a href="<?php echo $userLoggedIn; ?>" class="prof-img"><img src="<?php echo $user['profile_pic']; ?>"></a>
                <a href="<?php echo $userLoggedIn; ?>" class="name"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a>
                <p class="username">@<?php echo $user['username']; ?></p>
                <div class="stats">
                    <div class="posts"><?php echo $user['num_posts'] ?>
                        <p>Posts</p>
                    </div>
                    <div class="posts"><?php echo $user['num_likes'] ?>
                        <p>Likes</p>
                    </div>
                </div>
            </div>
            <footer style="font-size: 12px;"><p>Copyright ©️ 2021 Bath Spa University | All Rights Reserved</p></footer><!-- Footer underneath the card. -->
        </div>
            
        <!-- Javascript to load the posts. -->
        <script>
            var userLoggedIn = '<?php echo $userLoggedIn; ?>';
            $(document).ready(function() {
                $('#loading').show();

                //Original ajax request for loading first posts 
                $.ajax({
                    url: "includes/handlers/ajax_load_posts.php",
                    type: "POST",
                    data: "page=1&userLoggedIn=" + userLoggedIn,
                    cache:false,

                    success: function(data) {
                        $('#loading').hide();
                        $('.posts_area').html(data);
                    }
                });

                $(window).scroll(function() {
                    var height = $('.posts_area').height(); //Div containing posts
                    var scroll_top = $(this).scrollTop();
                    var page = $('.posts_area').find('.nextPage').val();
                    var noMorePosts = $('.posts_area').find('.noMorePosts').val();

                    if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
                        $('#loading').show();

                        var ajaxReq = $.ajax({
                            url: "includes/handlers/ajax_load_posts.php",
                            type: "POST",
                            data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                            cache:false,

                            success: function(response) {
                                $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
                                $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 

                                $('#loading').hide();
                                $('.posts_area').append(response);
                            }
                        });

                    } //End if 
                    return false;
                }); //End (window).scroll(function())
            });
	    </script>
        <script src="assets/js/post.js"></script><!-- To load the post button -->
    </div>
</body>
</html>