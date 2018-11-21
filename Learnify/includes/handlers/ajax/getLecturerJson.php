<?php

//go up two folders to config file that contains the database connection
include("../../config.php");

if(isset($_POST['lecturerId'])){
	$lecturerId = $_POST['lecturerId'];

	$query = mysqli_query($con, "SELECT * FROM lecturers WHERE id='$lecturerId'");

	$resultArray = mysqli_fetch_array($query);

	echo json_encode($resultArray);

}

?>