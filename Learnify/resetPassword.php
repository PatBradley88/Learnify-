<?php
include("includes/config.php");

if(!isset($_GET["code"])) {
	exit("Can't find page");
}

$code = $_GET["code"];

$getEmailQuery = mysqli_query($con, "SELECT email FROM resetPasswords WHERE code = '$code'");
if(mysqli_num_rows($getEmailQuery) == 0) {
	exit("Can't find page");
}

if(isset($_POST["password"])) {
	$pw = $_POST["password"];
	$pw = md5($pw);

	$row = mysqli_fetch_array($getEmailQuery);
	$email = $row["email"];

	$query = mysqli_query($con, "UPDATE users SET password='$pw' WHERE email='$email'");

	if($query) {
		$query = mysqli_query($con, "DELETE FROM resetPasswords WHERE code='$code'");
		exit("Password updated");
	}
	else {
		exit("Something went wrong");
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

		<link rel="stylesheet" type="text/css" href="assets/css/requestReset.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/js/register.js"></script>

</head>
<body>

	<div id="resetBackground"> 

        <div id="resetContainer">

            <div id="inputResetContainer">
                
                <form id="resetloginForm" method="POST">
					<input type="password" name="password" placeholder="New password">
					<br>
					<button type="submit" name="submit" value="Update password">Submit</button> 
				</form>

            </div>
        </div>
    </div>

</body>
</html>
