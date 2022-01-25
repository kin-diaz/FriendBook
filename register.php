<?php include("includes/header.php"); ?>
    
<!-- Register page. -->
    <div class="register-page">
        <div class="content">
            <div class="header" onClick="location.href='index.php'">
                <h3>FRIEND</h3>
                <img src="assets/images/icons/logo.png" alt="logo" class="logo" height="50px">
                <h3>BOOK</h3>
            </div>
            <div class="text">
                <h1>Create a new account</h1>
                <?php 
                    if(in_array("<span style='color: #000;'>You're all set! Go ahead and login!</span><br>", $error_array)) { echo "<p class='msg' style='color: #5E7CE2;'>You're all set! Go ahead and login!</p>"; }
                    else { echo "<p class='msg'>effortlessly and start swimming with other fishes</p>";}
                ?>

                <form action="register.php" method="POST">
                    <!-- Fields for the name -->
                    <div class="name">
                        <label class="custom-field">
                            <input type="text" name="reg_fname" value="<?php 
                                if(isset($_SESSION['reg_fname'])) {
                                    echo $_SESSION['reg_fname'];
                                } 
                                ?>" required/>
                            <span class="placeholder">First name</span>
                        </label>
                        <label class="custom-field">
                            <input type="text" name="reg_lname" value="<?php 
                                if(isset($_SESSION['reg_lname'])) {
                                    echo $_SESSION['reg_lname'];
                                } 
                                ?>" required/>
                            <span class="placeholder">Last name</span>
                        </label>
                    </div>
                    <!-- Error message -->
                    <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "<p style='color:#F87060; font-size: 12px; margin: 5px 0; '>Your first name must be between 2 and 25 characters</p>"; ?>
                    <?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "<p style='color:#F87060; font-size: 12px; margin: 5px 0; '>Your last name must be between 2 and 25 characters</p>"; ?>

                    <!-- Fields for the emails -->
                    <label class="custom-field">
                        <input type="email" name="reg_email" value="<?php 
                            if(isset($_SESSION['reg_email'])) {
                                echo $_SESSION['reg_email'];
                            } 
                            ?>" required/>
                        <span class="placeholder">Enter GMAIL</span>
                    </label>
                    <label class="custom-field">
                        <input type="email" name="reg_email2" value="<?php 
                            if(isset($_SESSION['reg_email2'])) {
                                echo $_SESSION['reg_email2'];
                            } 
                            ?>" required/>
                        <span class="placeholder">Confirm GMAIL</span>
                    </label>
                    <!-- Error messages -->
                    <?php 
                        if(in_array("Email already in use<br>", $error_array)) echo "<p style='color:#F87060; font-size: 12px; margin: 5px 0; '>Email already in use </p>"; 
                        else if(in_array("Invalid email format<br>", $error_array)) echo "<p style='color:#F87060; font-size: 12px; margin: 5px 0; '>Invalid email format</p>";
                        else if(in_array("Emails don't match<br>", $error_array)) echo "<p style='color:#F87060; font-size: 12px; margin: 5px 0; '>Emails don't match</p>"; 
                    ?>
                    <!-- Field for the passwords -->
                    <label class="custom-field">
                        <input type="password" name="reg_password" required/>
                        <span class="placeholder">Enter password</span>
                    </label>
                    <label class="custom-field">
                        <input type="password" name="reg_password2" required/>
                        <span class="placeholder">Confirm password</span>
                    </label>
                    <input type="submit" name="register_button" class="register-btn" value="REGISTER">
                </form>
                <p class="option">Already have an account? <a onClick="location.href='login.php'">Login</a></p><!-- Login button -->
            </div>
            <footer><p>Copyright ©️ 2021 Bath Spa University | All Rights Reserved</p></footer><!-- Footer -->
        </div>
        <div class="illustration"></div><!-- Illustration for visuals. -->
    </div>
</body>
</html>