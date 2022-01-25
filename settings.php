<?php 
include("includes/header2.php");
include("includes/form_handlers/settings_handler.php");
?>

<!-- Settings page. -->
	<div class="settings-page">
		<h4>Account Settings</h4>
		<!-- Message -->
		<?php 
		if($message == "") { ?>
			<p class="info">Update your photo and personal details here.</p><?php 
		} 
		else if ($message == "Details updated!<br><br>") { ?>
			<p class="info" style="color:#5E7CE2; font-weight:bold;">Details updated!</p><?php 
		} 
		else if ($message == "That email is already in use!<br><br>") { ?>
			<p class="info" style="color:#FF2E00; font-weight:bold;">That email is already in use!</p><?php 
		} ?>
		<hr>
		<!-- Gets the data from the database. -->
		<?php
			$user_data_query = mysqli_query($con, "SELECT first_name, last_name, email FROM users WHERE username='$userLoggedIn'");
			$row = mysqli_fetch_array($user_data_query);

			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];
		?>
		<!-- Form for users to change their first name, last name, email and profile picture. -->
		<form action="settings.php" method="POST">
			<div class="section">
				<p>First Name</p>
				<input type="text" name="first_name" value="<?php echo $first_name; ?>" id="settings_input">
			</div>
			<hr>
			<div class="section">
				<p>Last Name</p>
				<input type="text" name="last_name" value="<?php echo $last_name; ?>" id="settings_input">
			</div>
			<hr>
			<div class="section">
				<p>Email</p>
				<input type="text" name="email" value="<?php echo $email; ?>" id="settings_input">
			</div>
			<hr>
			<div class="section pic">
				<p>Profile Picture</p>
				<div>
					<div class="prof-pic"><?php echo "<img src='" . $user['profile_pic'] ."'>"; ?></div>
					<a href="upload.php">Change</a>
				</div>
			</div>
			<hr>
			<input type="submit" name="update_details" id="save_details" value="Update Details" class="info settings_submit">
			<br>
			<br>
			<br>
		</form>

		<!-- To change their password. -->
		<h4>Change Password</h4>
		<!-- Message changes according to their request. -->
		<?php 
		if($password_message == "") { ?>
			<p class="info">Change your current password with a better one here.</p><?php 
		} 
		else if ($password_message == "Password has been changed!<br><br>") { ?>
			<p class="info" style="color:#5E7CE2; font-weight:bold;">Password has been changed!</p><?php 
		} 
		else if ($password_message == "Sorry, your password must be greater than 4 characters<br><br>") { ?>
			<p class="info" style="color:#FF2E00; font-weight:bold;">Sorry, your password must be greater than 4 characters</p><?php 
		} 
		else if ($password_message == "Your two new passwords need to match!<br><br>") { ?>
			<p class="info" style="color:#FF2E00; font-weight:bold;">Your two new passwords need to match!</p><?php 
		}
		else if ($password_message == "The old password is incorrect! <br><br>") { ?>
			<p class="info" style="color:#FF2E00; font-weight:bold;">The old password is incorrect!</p><?php 
		} ?>
		
		<hr>
		<!-- Actual form -->
		<form action="settings.php" method="POST">
			<div class="section">
				<p>Old Password</p>
				<input type="password" name="old_password" id="settings_input">
			</div>
			<hr>
			<div class="section">
				<p>New Password</p>
				<input type="password" name="new_password_1" id="settings_input">
			</div>
			<hr>
			<div class="section">
				<p>New Password Again</p>
				<input type="password" name="new_password_2" id="settings_input">
			</div>
			<hr>
			<input type="submit" name="update_password" id="save_details" value="Update Password" class="info settings_submit">
			<br><br><br>
		</form>

		<!-- Place where they can close their account if they want. -->
		<h4>Close Account</h4>
		<hr>
		<form action="settings.php" method="POST">
			<input type="submit" name="close_account" id="close_account" value="Close Account" class="danger settings_submit">
			<br>
			<br>
			<br>
		</form>
	</div>
	<footer class="settings-footer"><p>Copyright ©️ 2021 Bath Spa University | All Rights Reserved</p></footer><!-- Footer. -->
	<script src="assets/js/post.js"></script><!-- Post button. -->
</body>
</html>