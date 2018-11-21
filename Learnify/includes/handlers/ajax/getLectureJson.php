<?php

//go up two folders to config file that contains the database connection
include("../../config.php");

if(isset($_POST['lectureId'])){
	$lectureId = $_POST['lectureId'];

	$query = mysqli_query($con, "SELECT * FROM lecture WHERE id='$lectureId'");

	$resultArray = mysqli_fetch_array($query);

	echo json_encode($resultArray);

}

?>