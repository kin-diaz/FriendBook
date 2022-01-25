<?php
// Code for handling the register functionality.

//Declaring variables to prevent errors
$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; //password 2
$date = ""; //Sign up date 
$error_array = array(); //Holds error messages

if(isset($_POST['register_button'])){

	//Registration form values

	//First name
	$fname = strip_tags($_POST['reg_fname']); //Remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	//Last name
	$lname = strip_tags($_POST['reg_lname']); //Remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	//email
	$em = strip_tags($_POST['reg_email']); //Remove html tags
	$em = str_replace(' ', '', $em); //remove spaces
	$em = ucfirst(strtolower($em)); //Uppercase first letter
	$_SESSION['reg_email'] = $em; //Stores email into session variable

	//email 2
	$em2 = strip_tags($_POST['reg_email2']); //Remove html tags
	$em2 = str_replace(' ', '', $em2); //remove spaces
	$em2 = ucfirst(strtolower($em2)); //Uppercase first letter
	$_SESSION['reg_email2'] = $em2; //Stores email2 into session variable

	//Password
	$password = strip_tags($_POST['reg_password']); //Remove html tags
	$password2 = strip_tags($_POST['reg_password2']); //Remove html tags

	$date = date("Y-m-d"); //Current date

	if($em == $em2) {
		//Check if email is in valid format 
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//Check if email already exists 
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

			//Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "Email already in use<br>");
			}

		}
		else {
			array_push($error_array, "Invalid email format<br>");
		}

	}
	else {
		array_push($error_array, "Emails don't match<br>");
	}

	if(strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array,  "Your last name must be between 2 and 25 characters<br>");
	}

	if($password != $password2) {
		array_push($error_array,  "Your passwords do not match<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Your password can only contain english characters or numbers<br>");
		}
	}

	if(strlen($password) > 30 || strlen($password) < 8) {
		array_push($error_array, "Your password must be betwen 8 and 30 characters<br>");
	}

	if(empty($error_array)) {
		$password = md5($password); //Encrypt password before sending to database

		//Generate username by concatenating first name and last name
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


		$i = 0; 
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

		//Profile picture assignment
		//Profile picture assignment
		$rand = rand(1, 13); //Random number between 1 and 21

		if($rand == 1)
			$profile_pic = "assets/images/profile_pics/defaults/aquamarine-andrey-prokopenko.webp";
		else if($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/dolphins-andrey-prokopenko.webp";
		else if($rand == 3)
			$profile_pic = "assets/images/profile_pics/defaults/fish-swirl-andrey-prokopenko.webp";
		else if($rand == 4)
			$profile_pic = "assets/images/profile_pics/defaults/killer-whale-andrey-prokopenko.webp";
		else if($rand == 5)
			$profile_pic = "assets/images/profile_pics/defaults/kraken-andrey-prokopenko.webp";
		else if($rand == 6)
			$profile_pic = "assets/images/profile_pics/defaults/lighthouse-andrey-prokopenko.webp";
		else if($rand == 7)
			$profile_pic = "assets/images/profile_pics/defaults/octopus-andrey-prokopenko.webp";
		else if($rand == 8)
			$profile_pic = "assets/images/profile_pics/defaults/on-shore-andrey-prokopenko.webp";
		else if($rand == 9)
			$profile_pic = "assets/images/profile_pics/defaults/ranging-river-andrey-prokopenko.webp";
		else if($rand == 10)
			$profile_pic = "assets/images/profile_pics/defaults/shark-andrey-prokopenko.webp";
		else if($rand == 11)
			$profile_pic = "assets/images/profile_pics/defaults/starfish-andrey-prokopenko.webp";
		else if($rand == 12)
			$profile_pic = "assets/images/profile_pics/defaults/stepped-river-andrey-prokopenko.webp";
		else if($rand == 13)
			$profile_pic = "assets/images/profile_pics/defaults/undersea-world-andrey-prokopenko.webp";

		$query = mysqli_query($con, "INSERT INTO users (first_name, last_name, username, email, password, signup_date, profile_pic, num_posts, num_likes, user_closed, friend_array) VALUES ('$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

		array_push($error_array, "<span style='color: #000;'>You're all set! Go ahead and login!</span><br>");

		//Clear session variables 
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}
}
?>