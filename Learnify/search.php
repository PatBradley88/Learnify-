<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
}
else {
	$term = "";
}
?>

<div class="searchContainer">
	
	<h4>Search for a lecturer, module or lecture</h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="this.value = this.value">

</div>

<script>

$(".searchInput").focus();
	
$(function() {
	var timer;

	$(".searchInput").keyup(function() {
		clearTimeout(timer);

		timer = setTimeout(function() {
			var val = $(".searchInput").val();
			openPage("search.php?term=" + val);
		}, 2000)
	})
})

</script>


<div class="lectureContainer borderBottom">
	<h2>LECTURES</h2>
  <ul class="lectureList">
    
    <?php
    $lectureQuery = mysqli_query($con, "SELECT id FROM lecture WHERE lectureTitle LIKE '$term%' LIMIT 10");

    if(mysqli_num_rows($lectureQuery) == 0) {
    	echo "<span class='noresults'>No lectures found matching " . $term . "</span>";
    }

    $lectureIdArray = array();
    
    $i=1;
    // place each lecture ID into the array
    while($row = mysqli_fetch_array($lectureQuery)) {

    	if($i > 15){
    		break;
    	}

    	array_push($lectureIdArray, $row['id']);
        
      $moduleLecture = new Lecture($con, $row['id']);
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