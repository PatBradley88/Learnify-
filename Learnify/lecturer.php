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

<div class="entityInfo borderBottom">

	<div class="centerSection">

		<div class="lecturerInfo">
		
			<!-- prints lecturer name using lecturer object -->
			<h1 class="lecturerName"><?php echo $lecturer->getName() ?></h1>

			<div class="headerButtons">
				<button class="button blue" onclick="playFirstSong()">PLAY</button>
			</div>

		</div>

	</div>

</div>




<div class="lectureContainer borderBottom">
	<h2>LECTURES</h2>
  <ul class="lectureList">
    
    <?php
    $lectureIdArray = $lecturer->getLectureIds();
    
    $i=1;
    // place each lecture ID into the array
    foreach($lectureIdArray as $lectureId) {

    	if($i > 5){
    		break;
    	}
        
      $moduleLecture = new Lecture($con, $lectureId);
      $moduleLecturer = $moduleLecture->getLecturer();
      
      echo "<li class='lectureListRow'>
              <div class='lectureCount'> 
                <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $moduleLecture->getId() ."\", tempContentlist, true)'>
                <span class='lectureNumber'>$i</span>
              </div>
              
              <div class='lectureInfo'> 
                <span class='lectureTitle'>" . $moduleLecture->getLectureTitle() . "</span>
                <span class='lecturerName'>" . $moduleLecturer->getName() . "</span>
              </div>
              
              <div class='lectureOptions'>
                <img class='optionsButton' src='assets/images/icons/more.png'>
              </div>
              
              <div class='lectureDuration'>
                <span class='duration'>" . $moduleLecture->getDuration() ."</span>
              </div>
              
            </li>";
      //increase the lecture count
      $i++;
      
    }
    
    ?>

<!--convert php array into json format
    convert json format into an object to access -->
    <script>
      var tempLectureIds = '<?php echo json_encode($lectureIdArray); ?>';
      tempContentlist = JSON.parse(tempLectureIds);
    </script>
  
  </ul>
</div>



<div class="gridViewContainer">

	<h2>MODULES</h2>

	<?php
		$moduleQuery = mysqli_query($con, "SELECT * FROM modules WHERE lecturer='$lecturerId'");
		
		while($row = mysqli_fetch_array($moduleQuery)) {
		
			echo "<div class = 'gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"module.php?id=" . $row['id'] . "\")'>
						<img src='" . $row['artworkPath'] ."'>

						<div class='gridViewInfo'>"

							. $row['moduleTitle'] .

						"</div>
					</span>
				</div>";
		}
	?>
	

</div>