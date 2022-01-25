<?php
include("includes/header2.php"); 

if(isset($_POST['cancel'])) {
    header("Location: settings.php");
}

if(isset($_POST['close_account'])) {
    $close_query = mysqli_query($con, "UPDATE users SET user_closed='yes' WHERE username='$userLoggedIn'");
    session_destroy();
    header("Location: index.php");
}
?>

        <div class="close-account-page">
            <h4>Close Account</h4>

            <p>Are you sure you want to close your account? It will hide all your activity from everyone else but you'll be able to reopen it by logging in!</p>
            <br><br>

            <form action="close-account.php" method="POST">
                <input type="submit" name="cancel" id="update_details" value="No" class="info settings_submit">
                <input type="submit" name="close_account" id="close_account" value="Sure" class="danger settings_submit">
            </form>
        </div>
    </div>
    <script src="assets/js/post.js"></script><!-- Post button can be clicked here too. -->
</body>
</html>