<?php
// Code for sending the reset request.

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST["reset_request_button"])) { //if the reset request button was clicked

        //two tokens for safety from timing-attacks by hackers
        $selector = bin2hex(random_bytes(8)); //check the token in the database
        $token = random_bytes(32); //authenticates the user

        $url = "http://localhost/FriendBook/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token); //creates the custom link

        $expires = date("U") + 1800; //expiry date is 1 hour from now

        require '../../config/config.php'; //connection file

        $userEmail = $_POST["reset_email"]; //get the email entered

        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;"; //deletes any existing tokens
        $stmt = mysqli_stmt_init($con);

        if (!mysqli_stmt_prepare($stmt, $sql)) { //checking for an error first
            echo "There was an error!";
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userEmail); //replaces the ? by binding the user's email
            mysqli_stmt_execute($stmt); //executes the statement
        }

        $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);"; //inserts the data into the database
        $stmt = mysqli_stmt_init($con);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "There was an error!";
            exit();
        }
        else {
            $hashedToken = password_hash($token, PASSWORD_DEFAULT); //hashes the token for security
            mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires); //creates a new token in the database
            mysqli_stmt_execute($stmt);
        }

        //closes the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($con);

        //Creates the email
        $to = $userEmail;
        $subject = "Reset your password for FriendBook.com";
        $message = '<p>We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email. Here is your password reset link: </br><a href="' . $url . '">' . $url . '</a></p>';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = '465';
        $mail->Username = 'friend.book.owner@gmail.com';
        $mail->Password = 'friendBook1.';
        $mail->Subject = $subject;
        $mail->setFrom('friend.book.owner@gmail.com');
        $mail->isHTML(true);
        $mail->Body = $message;
        $mail->addAddress($to);
        $mail->Send();

        $mail->smtpClose();

        header("Location: ../../reset-password.php?reset=success"); //returns the user back to the page
    }
    else {
        header("location:../../login.php"); //else send them back to the login page
    }

?>