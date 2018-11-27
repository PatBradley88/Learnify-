<?php include("includes/includedFiles.php");
  if(isset($_GET['id'])) {
    $playlistID = $_GET['id'];
  }
  else {
    header("Location: index.php");
  }
  $playlist = new Playlist($con, $playlistID);
  $owner = new User($con, $playlist->getOwner());
?>



<div class="entityInfo">
   <div class="leftSection">
     <img src="assets/images/icons/playlist.png">
    
  </div>
  <div class="rightSection">
    <h2>
      <?php echo $module->getTitle(); ?>
    </h2>
    <p><?php echo $lecturer->getName(); ?></p>
    <p><?php echo $module->getVideoCount(); ?> Videos</p>
  </div>
</div>

<div class="lectureContainer">
  <ul class="lectureList">
    
    <?php
    $lectureIdArray = $module->getLectureIds();
    
    $i=1;
    // place each lecture ID into the array
    foreach($lectureIdArray as $lectureId) {
        
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