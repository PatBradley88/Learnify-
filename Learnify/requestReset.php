<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'includes/config.php';


if(isset($_POST["email"])) {

    $emailTo = $_POST["email"];

    $code = uniqid(true);
    $query = mysqli_query($con, "INSERT INTO resetPasswords(code, email) VALUES('$code', '$emailTo')");
    if(!$query) {
        exit("Error");
    }


    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'learnifynci@gmail.com';            // SMTP username
            $mail->Password = 'TeamProjectPHP18';                 // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('learnifynci@gmail.com', 'Learnify!');
            $mail->addAddress($emailTo);           // Add a recipient
            $mail->addReplyTo('no-reply@learnify.com', 'No Reply');
            

            //Content
            $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code";
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Learnify';
            $mail->Body    = "<h1>You requested a password reset</h1>
            Click <a href='$url'>this link</a> to do so";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Reset password link has been sent to your email';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
    exit();
}


?>

<!DOCTYPE html>
<html>
<head>
    <title></title>

        <link rel="stylesheet" type="text/css" href="assets/css/requestReset.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/js/register.js"></script>

</head>
<body>

    <div id="resetBackground"> 

        <div id="resetContainer">

            <div id="inputResetContainer">
                <form id="resetloginForm" action="requestReset.php" method="POST">
                    <h2>Reset your Password</h2>
                    <p>
                        <label for="loginUsername">Email</label>
                        <input id="loginUsername" type="text" name="email" placeholder="eg. peter.griffin@gmail.com">
                    </p>

                    <button type="submit" name="submit" value="Reset email">Submit</button>

                </form>


            </div>
        </div>
    </div>

</body>
</html>






