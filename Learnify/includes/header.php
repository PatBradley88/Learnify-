<?php 
include("includes/config.php");
include("includes/classes/Lecturer.php");
include("includes/classes/Module.php");
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
  

  
</head>
<body>
  
    <div id="mainContianer">
    <div id="topContainer">
      
    	<?php include("includes/navBarContainer.php"); ?>

    	<div id="mainViewContainer">

    		<div id="mainContent">