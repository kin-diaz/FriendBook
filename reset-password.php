<?php require 'includes/header.php'; ?>

<!-- Reset password page. -->
    <div class="reset-page">
        <div class="content">
            <div class="header" onClick="location.href='index.php'">
                <h3>FRIEND</h3>
                <img src="assets/images/icons/logo.png" alt="logo" class="logo" height="50px">
                <h3>BOOK</h3>
            </div>
            <div class="text">
                <h1>Reset Password</h1>
                <p class="msg">Don’t get lost, we’re here to help. Enter your email address.</p>
                <!-- Form to get the email from the user. -->
                <form action="includes/form_handlers/reset_request.php" method="POST">
                    <label class="custom-field">
                        <input type="email" name="reset_email" id="email" required/>
                        <span class="placeholder">Enter GMAIL</span>
                    </label>
                    <input type="submit" name="reset_request_button" class="reset-btn" value="SEND INSTRUCTIONS">
                </form>
                <?php if (isset($_GET["reset"])) { if ($_GET["reset"] == "success") { echo '<p class="sucess">We have sent a password recovery instruction to your email.</p>'; }}?>
            </div>
            <footer><p>Copyright ©️ 2021 Bath Spa University | All Rights Reserved</p></footer><!-- Footer. -->
        </div>
        <div class="illustration"></div><!-- Illustration for visuals. -->
    </div>
</body>
</html>