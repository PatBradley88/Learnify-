<?php

//go up two folders to config file that contains the database connection
include("../../config.php");

if(isset($_POST['moduleId'])){
	$moduleId = $_POST['moduleId'];

	$query = mysqli_query($con, "SELECT * FROM modules WHERE id='$moduleId'");

	$resultArray = mysqli_fetch_array($query);

	echo json_encode($resultArray);

}

?>