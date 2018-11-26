<?php

include("includes/includedFiles.php");

//ID passed through the url
if(isset($_GET['id'])) {
  $lecturerId = $_GET['id'];
}
else {
  header("Location: index.php");
}

//creates lecturer object from Lecturer class
$lecturer = new Lecturer($con, $lecturerId);
?>

<div class="entityInfo">

	<div class="centerSection">

		<div class="lecturerInfo">
		
			<!-- prints lecturer name using lecturer object -->
			<h1 class="lecturerName"><?php echo $lecturer->getName() ?></h1>

			<div class="headerButtons">
				<button class="button blue">PLAY</button>
			</div>

		</div>

	</div>

</div>