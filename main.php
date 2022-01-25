<?php 
include("includes/header2.php");
?>
    
    <!-- Main page where users can see their own and friends' posts -->
    <div class="main-page">
        <div class="left"><!-- General -->
            <h4>#General</h4>
            <p class="info">Zone where only you and your friends can hangout.</p>
            <div class="posts_area"></div>
            <div class="loading-div" width="50px" height="50px"><img id="loading" src="assets/images/icons/loading.gif"></div>
        </div>
        <div class="right">
            <div class="card" style="margin-bottom: 25px;">
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
            <div class="card trends"><!-- Trending words in the website -->
                <h4>Trending Words</h4>
                <div class="trends" style="color:#5E7CE2;">
                    <?php 
                    $query = mysqli_query($con, "SELECT * FROM trends ORDER BY hits DESC LIMIT 9");
                    
                    foreach ($query as $row) {
                        $word = $row['title'];
                        $word_dot = strlen($word) >= 14 ? "..." : "";

                        $trimmed_word = str_split($word, 14);
                        $trimmed_word = $trimmed_word[0];

                        echo "<div style'padding: 1px'>#";
                        echo $trimmed_word . $word_dot;
                        echo "<br></div><br>";
                    }
                    ?>
                </div>
            </div>
            <footer style="font-size: 12px;"><p>Copyright ©️ 2021 Bath Spa University | All Rights Reserved</p></footer><!-- Footer -->
        </div>
            
        <!-- Javascript for the AJAX request to load in the posts and act as the infinite scroll. -->
        <script>
            var userLoggedIn = '<?php echo $userLoggedIn; ?>';

            $(document).ready(function() {
                $('#loading').show();

                //Original ajax request for loading first posts.
                $.ajax({
                    url: "includes/handlers/ajax_load_friend_posts.php",
                    type: "POST",
                    data: "page=1&userLoggedIn=" + userLoggedIn,
                    cache:false,

                    success: function(data) {
                        $('#loading').hide();
                        $('.posts_area').html(data);
                    }
                });

                $(window).scroll(function() {
                    var height = $('.posts_area').height(); //Div containing posts.
                    var scroll_top = $(this).scrollTop();
                    var page = $('.posts_area').find('.nextPage').val();
                    var noMorePosts = $('.posts_area').find('.noMorePosts').val();

                    if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
                        $('#loading').show();

                        var ajaxReq = $.ajax({
                            url: "includes/handlers/ajax_load_friend_posts.php",
                            type: "POST",
                            data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                            cache:false,

                            success: function(response) {
                                $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage.
                                $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage. 

                                $('#loading').hide();
                                $('.posts_area').append(response);
                            }
                        });

                    } //End if 
                    return false;
                }); //End (window).scroll(function())
            });
	    </script>
        <script src="assets/js/post.js"></script><!-- Post button functionality. -->
    </div>
</body>
</html>