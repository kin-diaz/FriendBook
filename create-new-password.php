<?php require 'includes/header.php'; ?>

<!-- Create new password page. -->

    <div class="create-page">
        <div class="content">
            <div class="header" onClick="location.href='index.php'">
                <h3>FRIEND</h3>
                <img src="assets/images/icons/logo.png" alt="logo" class="logo" height="50px">
                <h3>BOOK</h3>
            </div>
            <div class="text">
                <h1>Create a new password</h1>
                <p class="msg">Make it unique. Make it different.</p>
                <?php 
                    $selector = $_GET["selector"];
                    $validator = $_GET["validator"];
                    
                    //Checks if the tokens are in the URL.
                    if(empty($selector) || empty($validator)) { //If not, outputs an error.
                        echo "Could not validate your request!";
                    }
                    else {
                        if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) { //Checks if the selector and validator is the right one.
                            ?>
                                <form action="includes/form_handlers/reset_password.php" method="POST">
                                    <input type="hidden" name="selector" value="<?php echo $selector ?>">
                                    <input type="hidden" name="validator" value="<?php echo $validator ?>">

                                    <label class="custom-field">
                                        <input type="password" name="new_password" required/>
                                        <span class="placeholder">Enter password</span>
                                    </label>  
                                    <label class="custom-field">
                                        <input type="password" name="new_password2" required/>
                                        <span class="placeholder">Confirm password</span>
                                    </label> 
                                    <input type="submit" name="reset_password_button" class="reset_button" value="RESET PASSWORD">
                                </form>
                            <?php
                        }
                    }
                ?>
                <?php if (isset($_GET["newpwd"]) && $_GET["newpwd"] == "passwordupdated") { echo '<p class="sucess">Password reset! Try logging in again by clicking on the logo.</p>'; }?>
            </div>
            <footer><p>Copyright ©️ 2021 Bath Spa University | All Rights Reserved</p></footer><!-- Footer -->
        </div>
        <div class="illustration"></div><!-- Illustration -->
    </div>
</body>
</html>