<?php

//if isset with ajax, execute this code
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
	include("includes/config.php");
	include("includes/classes/User.php");
	include("includes/classes/Lecturer.php");
	include("includes/classes/Module.php");
	include("includes/classes/Lecture.php");
	include("includes/classes/Contentlist.php");

	if(isset($_GET['userLoggedIn'])){
		$userLoggedIn = new User($con, $_GET['userLoggedIn']);
	}
	else {
		echo "username variable not passed into page. Check the openPage JS function";
		exit();
	}
}
//otherwise execute this code
else {
	include("includes/header.php");
	include("includes/footer.php");

	//executes openPage function
	$url = $_SERVER['REQUEST_URI'];
	echo"<script>openPage('$url')</script>";
	exit();
}

?>