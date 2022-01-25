<?php include("includes/header.php"); ?>
    
<!-- Login page to help users login -->
    <div class="login-page">
        <div class="content">
            <div class="header" onClick="location.href='index.php'">
                <h3>FRIEND</h3>
                <img src="assets/images/icons/logo.png" alt="logo" class="logo" height="50px">
                <h3>BOOK</h3>
            </div>
            <div class="text">
                <h1>Sign in to your account</h1>
                <p class="msg">and explore beyond your horizons</p>
                <form action="login.php" method="POST"><!-- Login form. -->
                    <label class="custom-field">
                        <input type="text" name="log_email" id="email" value="<?php 
                        if(isset($_SESSION['log_email'])) {
                            echo $_SESSION['log_email'];
                        } 
                        ?>" required/>
                        <span class="placeholder">Enter GMAIL</span>
                    </label>
                    <label class="custom-field">
                        <input type="password" name="log_password" id="password" required/>
                        <span class="placeholder">Enter password</span>
                    </label>
                    <?php if(in_array("Email or password was incorrect<br>", $error_array)) echo "<p style='color:#F87060; font-size: 12px; margin: 5px; '>Email or password was incorrect<br>"; ?>
                <div class="other">
                    <div class="remember">
                        <input type="checkbox" name="remember-me" id="remember-me" onclick="setCookie()" autocomplete="off">
                        <label for="remember-me">Remember Me</label>
                    </div>
                    <div class="forgot-pass">
                        <a href="reset-password.php">Forgot Password?</a>
                    </div>
                </div>
                    <input type="submit" name="login_button" class="login-btn" value="LOGIN">
                </form>
                <p class="option">Don’t have an account yet? <a onClick="location.href='register.php'">Register Here</a></p>
            </div>
            <footer><p>Copyright ©️ 2021 Bath Spa University | All Rights Reserved</p></footer><!-- Footer -->
        </div>
        <div class="illustration"></div><!-- Illustration for visuals -->
    </div>
</body>
</html>