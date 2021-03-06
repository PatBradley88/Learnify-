<?php include("includes/includedFiles.php");
  if(isset($_GET['id'])) {
    $playlistID = $_GET['id'];
  }
  else {
    header("Location: index.php"); 
  }
  $playlist = new Playlist($con, $playlistID); //Video 144 06m00s -> end there is cover on how to get this information correctly
    // if(!is_array($data)) {
      // data is an id (string)
      // $query = mysqli_query($con, "SELECT * FROM playlists WHERE id='$data'");
      // $data = msqyli_fetch_array($query);
    }
  $owner = new User($con, $playlist->getOwner()); # we want to get the name of the user that created the playlist
                                                  # so we get this from the playlist class because it's not
                                                  # always going to be the current user logged in


?>


<div class="entityInfo">
   <div class="leftSection">
     <div class="playlistImage">
       <img src="assets/images/icons/playlist.png">
     </div>
     
    
  </div>
  <div class="rightSection">
    <h2><?php echo $playlist->getName(); ?></h2>
    <p>By <?php echo $playlist->getOwner(); ?></p>
    <p><?php echo $playlist->getVideoCount(); ?> videos</p>
    <!-- function for the Playlist.php class to get video count 
    
    public function getNumberOfVideos() {
      $query = mysqli_query($this->con, "Select videoId FROM playlistVideos WHERE playlistId='$this->id'");
      return mysqli_num_rows($query);
    } -->

    
    <button class="button">Delete Playlist</button>
  </div>
</div>

<div class="lectureContainer">
  <ul class="lectureList">
    
    <?php
    $lectureIdArray = //$module->getLectureIds();
    
    $i=1;
    // place each lecture ID into the array
    foreach($lectureIdArray as $lectureId) {
      
      // changed all moduleLecture to playlistLecture (lines 56, 61, 66, 75)
      // changed all moduleLecturer to lectureLecturer (lines 57 and 67)
        
      $playlistLecture = new Lecture($con, $lectureId);
      $lectureLecturer = $playlistLecture->getLecturer();
      
      echo "<li class='lectureListRow'>
              <div class='lectureCount'> 
                <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $playlistLecture->getId() ."\", tempContentlist, true)'>
                <span class='lectureNumber'>$i</span>
              </div>
              
              <div class='lectureInfo'> 
                <span class='lectureTitle'>" . $playlistLecture->getLectureTitle() . "</span>
                <span class='lecturerName'>" . $lectureLecturer->getName() . "</span>
              </div>
              
              <div class='lectureOptions'>
                <img class='optionsButton' src='assets/images/icons/more.png'>
              </div>
              
              <div class='lectureDuration'>
                <span class='duration'>" . $playlistLecture->getDuration() ."</span>
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