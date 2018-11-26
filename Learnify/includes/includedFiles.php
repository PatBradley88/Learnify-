<?php

//if isset with ajax, execute this code
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
	include("includes/config.php");
	include("includes/classes/Lecturer.php");
	include("includes/classes/Module.php");
	include("includes/classes/Lecture.php");
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