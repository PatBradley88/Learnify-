<?php include("includes/includedFiles.php");
  if(isset($_GET['id'])) {
    $contentlistID = $_GET['id'];
  }
  else {
    header("Location: index.php"); 
  }
  // creates the contentlist object
  $contentlist = new Contentlist($con, $contentlistID); //Video 144 06m00s -> end there is cover on how to get this information correctly
    // if(!is_array($data)) {
      // data is an id (string)
      // $query = mysqli_query($con, "SELECT * FROM playlists WHERE id='$data'");
      // $data = msqyli_fetch_array($query);

  //creates the contenlist owner object
  $owner = new User($con, $contentlist->getOwner()); # we want to get the name of the user that created the playlist
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
    <h2><?php echo $contentlist->getName(); ?></h2>
    <p>By <?php echo $contentlist->getOwner(); ?></p>
    <p><?php echo $contentlist->getNumberOfVideos(); ?> videos</p>
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
        
      $contentlistLecture = new Lecture($con, $lectureId);
      $lectureLecturer = $contentlistLecture->getLecturer();
      
      echo "<li class='lectureListRow'>
              <div class='lectureCount'> 
                <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $contentlistLecture->getId() ."\", tempContentlist, true)'>
                <span class='lectureNumber'>$i</span>
              </div>
              
              <div class='lectureInfo'> 
                <span class='lectureTitle'>" . $contentlistLecture->getLectureTitle() . "</span>
                <span class='lecturerName'>" . $lectureLecturer->getName() . "</span>
              </div>
              
              <div class='lectureOptions'>
                <img class='optionsButton' src='assets/images/icons/more.png'>
              </div>
              
              <div class='lectureDuration'>
                <span class='duration'>" . $contentlistLecture->getDuration() ."</span>
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