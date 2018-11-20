<?php 
include("includes/config.php");
include("includes/classes/Lecturer.php");
include("includes/classes/Module.php");
include("includes/classes/Lecture.php");
//session_destroy();

if(isset($_SESSION['userLoggedIn'])){
	$userLoggedIn = $_SESSION['userLoggedIn'];
} else {
	header("Location: register.php");
}

?>
<html>
<head>
	<title>Welcome to Learnify!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<!-- jQuery library hosted by Google link -->  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Including Javascript file -->
	<script src="assets/js/script.js"></script>
  
</head>
<body>
  <!-- script code to make an audio content to play as you load the page -->
	<!-- <script>
		var audioElement = new Audio();
		audioElement.setTrack("assets/audio/01_Badlands.m4a");
		audioElement.audio.play();
	</script> -->

    <div id="mainContianer">
    <div id="topContainer">
      
    	<?php include("includes/navBarContainer.php"); ?>

    	<div id="mainViewContainer">

    		<div id="mainContent">