<?php
include("includes/header2.php"); 
?>

<!-- Requests page -->
	<div class="requests-page">
		<h4>Friend Requests</h4>
		<p class="info">These people would like to be your friend! Your choice now, buddy!</p>

		<!-- Code to call out the requests one by one from the database. -->
		<?php  
		$query = mysqli_query($con, "SELECT * FROM friend_requests WHERE user_to='$userLoggedIn'");
		if(mysqli_num_rows($query) == 0)
			echo "You have no friend requests at this time!";
		else {

			while($row = mysqli_fetch_array($query)) {
				?><div class='request'><?php
					$user_from = $row['user_from'];
					$user_from_obj = new User($con, $user_from);

					echo $user_from_obj->getFirstAndLastName() . " sent you a friend request!";

					$user_from_friend_array = $user_from_obj->getFriendArray();

					if(isset($_POST['accept_request' . $user_from ])) {
						$add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$user_from,') WHERE username='$userLoggedIn'");
						$add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$userLoggedIn,') WHERE username='$user_from'");

						$delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
						echo "You are now friends!";
						header("Location: requests.php");
					}
					if(isset($_POST['ignore_request' . $user_from ])) {
						$delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
						echo "Request ignored!";
						header("Location: requests.php");
					}
					?>
					<form action="requests.php" method="POST">
						<input type="submit" name="accept_request<?php echo $user_from; ?>" id="accept_button" value="Accept">
						<input type="submit" name="ignore_request<?php echo $user_from; ?>" id="ignore_button" value="Ignore">
					</form>
				</div>
				<?php
			}
		}
		?>
        <script src="assets/js/post.js"></script><!-- Post button can be clicked here too. -->
		<footer style="font-size: 12px;"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><p>Copyright ©️ 2021 Bath Spa University | All Rights Reserved</p></footer><!-- Long footer to give space between the elements. -->
	</div>
</div>
</body>
</html>